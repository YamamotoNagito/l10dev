<script setup>
import { ref, watch } from 'vue';
import vuetify from '../js/vuetify';
import Header from './Header.vue';
import Footer from './Footer.vue';
import axios from 'axios';
import { jsx } from 'vue/jsx-runtime';
import { useRouter } from 'vue-router'
import { useStore } from 'vuex';

const router = useRouter();
const store = useStore();

const userName = ref('');
const userEmail = ref('');
const password = ref('');

const universityName = ref('');
const category = ref('');
const faculty = ref('');
const department = ref('');
const admissionYear = ref('');
const passwordCheck = ref('');

// 新規登録に関するapiを呼び出してくる 
// 書き方は,Login.vueを参照すること

const categoryItems = ref([
  '高校生', 
  '大学生', 
  '大学院生', 
  'OB', 
  '大学教職員', 
  'その他'
]);

const facultyItems = ref([
  // categoryに合わせて変化させる. 
]);
const departmentItems = ref([
  // facultyに合わせて変化させる. 
]);
const admissionYearItems = ref([
  // categoryに合わせて変化させる. 
]);

const updateFacultyItems = () => {
  // console.log("facultyがアップデートされたで");
  if(category.value === '高校生' || category.value === '大学教職員' || category.value === 'OB' || category.value === 'その他') {
    facultyItems.value = ['その他'];
  } else if (category.value === '大学生') {
    facultyItems.value = ['総合科学部', '文学部', '教育学部', '法学部', '経済学部', '理学部', '医学部', '歯学部', '薬学部', '工学部', '生物生産学部','情報科学部', 'その他'];
  } else if (category.value === '大学院生') {
    facultyItems.value = ['人間社会科学研究科', '先進理工系科学研究科', '統合生命科学研究科', '医系科学研究科', 'スマートソサエティ実践科学研究院', 'その他'];
  } else {
    facultyItems.value = [''];
    console.log("facultyは何も選択できません");
  }
    faculty.value = null; // 子コンボボックスの選択をリセット
};

const updateAdmissionYearItems = () => {
  // console.log("AdmissionYearがアップデートされたで");
  if(category.value === '高校生' || category.value === '大学教職員' || category.value === 'OB' || category.value === 'その他') {
    admissionYearItems.value = ['その他'];
  } else if (category.value === '大学生' || category.value === '大学院生') {
    admissionYearItems.value = [2017, 2018, 2019, 2020, 2021, 2022, 2023, 2024];
  } else {
    admissionYearItems.value = [''];
    console.log("AdmissionYearは何も選択できません");
  }
    faculty.value = null; // 子コンボボックスの選択をリセット
};

const updateDepartmentItems = () => {
  //選択された faculty に合わせて departmentItems の選択肢を変化させる
  console.log("departmentがアップデートされたで");
  if(faculty.value === '総合科学部') {
    departmentItems.value = ['総合科学科', '国際共創学科', 'その他'];
    // console.log( departmentItems.value);
  } else if (faculty.value === '文学部') {
    departmentItems.value = ['人文学科', 'その他'];
    // console.log( departmentItems.value);
  } else if (faculty.value === '教育学部') {
    departmentItems.value = ['学校教育系', '科学文化教育系', '言語文化教育系', '生涯活動教育系', '人間形成基礎系', 'その他'];
    // console.log( departmentItems.value);
  } else if (faculty.value === '法学部') {
    departmentItems.value = ['法学科', 'その他'];
    // console.log( departmentItems.value);
  } else if (faculty.value === '経済学部') {
    departmentItems.value = ['経済学科', 'その他'];
    // console.log( departmentItems.value);
  } else if (faculty.value === '理学部') {
    departmentItems.value = ['物理学科', '地球惑星システム学科', '生物科学科', '数学科', '化学科', 'その他'];
    // console.log( departmentItems.value);
  } else if (faculty.value === '医学部') {
    departmentItems.value = ['医学科', '保健学科', 'その他'];
    // console.log( departmentItems.value);
  } else if (faculty.value === '歯学部') {
    departmentItems.value = ['歯学科', '口腔健康科学科', 'その他'];
    // console.log( departmentItems.value);
  } else if (faculty.value === '薬学部') {
    departmentItems.value = ['薬学科', '薬科学科', 'その他'];
    // console.log( departmentItems.value);
  } else if (faculty.value === '工学部') {
    departmentItems.value = ['第1類(機械・輸送・材料・エネルギー系)', '第2類(電気電子・システム情報系)', '第3類(応用化学・生物工学・化学工学系)', '第4類(建設・環境系)', 'その他'];
    // console.log( departmentItems.value);
  } else if (faculty.value === '生物生産学部') {
    departmentItems.value = ['生物生産学科', 'その他'];
    // console.log( departmentItems.value);
  } else if (faculty.value === '情報科学部') {
    departmentItems.value = ['情報科学科', 'その他'];
    // console.log( departmentItems.value);
  } else if (faculty.value === '人間社会科学研究科') {
    departmentItems.value = ['人文社会科学専攻', '教育科学専攻', '教職開発専攻（教職大学院）', '実務法学専攻（法科大学院）', '国際連携専攻', 'その他'];
    // console.log( departmentItems.value);
  } else if (faculty.value === '先進理工系科学研究科') {
    departmentItems.value = ['先進理工系科学専攻', '国際連携専攻', 'その他'];
    // console.log( departmentItems.value);
  } else if (faculty.value === '統合生命科学研究科') {
    departmentItems.value = ['統合生命科学専攻', 'その他'];
    // console.log( departmentItems.value);
  } else if (faculty.value === '医系科学研究科') {
    departmentItems.value = ['医歯薬学専攻', '総合健康科学専攻', '総合健康科学専攻', 'その他'];
    // console.log( departmentItems.value);
  } else if (faculty.value === 'スマートソサエティ実践科学研究院') {
    departmentItems.value = ['その他'];
    // console.log( departmentItems.value);
  } else if (faculty.value === 'その他') {
    departmentItems.value = ['その他'];
    // console.log( departmentItems.value);
  } else {
    departmentItems.value = [''];
    console.log("departmentは何も選択できません");
  }
    department.value = null; // 子コンボボックスの選択をリセット
};

// facultyで選択された値が変更されたときに発火する関数
// その他の変更時の発火処理はwatchを使うこと
watch(faculty, () => {
  updateDepartmentItems();
});

watch(category, () => {
  updateFacultyItems();
  updateAdmissionYearItems();
});

//e-mailのバリデーションチェック
const emailRule = value => {
  const pattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
  return pattern.test(value) || '有効なメールアドレスを入力してください。';
};

// 入力のルールをチェックする関数
const checkValidation = () => {
  if (userName.value.length == 0) {
    alert('名前を入力してください');
    return '名前未入力';
  }
  else if (userEmail.value.length == 0) {
    alert('メールアドレスを入力してください');
    return 'e-mail未入力';
  }
  else if (password.value.length == 0) {
    alert('パスワードを入力してください');
    return 'pass未入力';
  }
  else if (password.value != passwordCheck.value) {
    console.log(password.value, passwordCheck.value);
    alert('パスワードが確認用の入力内容と一致しません');
    return '確認用pass不一致';
  }
  else if (password.value.length >= 32 || password.value.length <= 8) {
    alert('パスワードは8文字以上32文字以下にしてください');
    return 'pass不満要件';
  }
  else if (universityName.value.length == 0) {
    alert('大学名を入力してください');
    return '大学名未入力';
  }
  else if (category.value.length == 0) {
    alert('所属を入力してください');
    return '所属未入力';
  }
  else if (faculty.value.length == 0) {
    alert('学部・研究科を入力してください');
    return '学部未入力';
  }
  else if (department.value.length == 0) {
    alert('学科・専攻を入力してください');
    return '学科未入力';
  }
  else if (admissionYear.value.length == 0) {
    alert('入学年度を入力してください');
    return '入学年度未入力';
  }
  else console.log(admissionYear.value, 'validation を満たしています');
};

const clickButton = async() => {
  // console.log("クリックされたで");

  checkValidation(); 
  // console.log('実行！！！');

  const data = {
    userName:userName.value,
    userEmail:userEmail.value,
    password:password.value,
    universityName:"広島大学",
    category:category.value,
    faculty:faculty.value,
    department:department.value,
    admissionYear:admissionYear.value,
  }

  //   await axios.post("/api/register", data)
  //   .then((response) => {
  //     // ちゃんと送信できたか確認用
  //     // console.log(response.data.success);
  //     // if(response.data.success){
  //       // } 
      //   store.dispatch('login', data);
  //       router.push('/profile');
  //   })
  //   .catch((err) => {
  //     console.log(err);
  //   });  
  try {
      const response = await axios.post("/api/register", data);
      console.log("response");
      // console.log(response);
      // console.log(response.data.id);
      data['id'] = response.data.id;
      data['role'] = response.data.role;
      // console.log(data['role']);
      store.dispatch('login', data);
      router.push('/profile');

    // その他の処理
    } catch (error) {
      if (error.response) {
        // サーバーからのエラーレスポンスがある場合
        console.error(error.response.data); // エラーレスポンスをコンソールに出力
      } else {
        // リクエストがサーバーに届かなかった場合など
        console.error(error.message);
      }
    }  
};

</script>

<template>
    <v-app>
        <!-- <v-main> -->
            <v-container>
                <h1 style="font-size: 2rem;">新規ユーザ登録</h1>
                <v-form action="" method="post">
                    <v-text-field
                    v-model="userName"
                    label="名前"
                    name="userName"
                    type="name"
                    ></v-text-field>
                    <v-text-field
                    v-model="userEmail"
                    label="メールアドレス"
                    name="userEmail"
                    type="email"
                    ></v-text-field>
                    <v-text-field
                      v-model="password"
                      label="パスワード"
                      name="password"
                      type="password"
                      clearable
                      required
                    ></v-text-field>
                    <v-text-field
                      v-model="passwordCheck"
                      label="パスワード確認"
                      name="passwordCheck"
                      type="password"
                      clearable
                      required
                    ></v-text-field>
                    <v-select
                      v-model="category"
                      :items="categoryItems"
                      label="所属"
                      name="category"
                      type="text"
                    ></v-select>
                    <v-select
                      v-model="faculty"
                      :items="facultyItems"
                      label="学部・研究科"
                      name="faculty"
                      type="text"
                    ></v-select>
                    <v-select
                      v-model="department"
                      :items="departmentItems"
                      label="学科・学類・専攻など"
                      name="department"
                      type="text"
                    ></v-select>
                    <v-select
                      v-model="admissionYear"
                      :items="admissionYearItems"
                      label="入学年度"
                      name="admissionYear"
                      type="number"
                    ></v-select>
                    <v-btn @click="clickButton">送信</v-btn>
                </v-form>
            </v-container>
        <!-- </v-main> -->
    </v-app>
</template>