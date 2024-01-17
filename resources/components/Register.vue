<script setup>
import { ref } from 'vue';
import vuetify from '../js/vuetify';
import Header from './Header.vue';
import Footer from './Footer.vue';
import axios from 'axios';
import { jsx } from 'vue/jsx-runtime';
import { useRouter } from 'vue-router'
import { useStore } from 'vuex';

const router = useRouter();
const store = useStore();

const user_name = ref('');
const user_email = ref('');
const password = ref('');
// const university_name = ref('');
const category = ref('');
const faculty = ref('');
const department = ref('');
const admission_year = ref();

// 新規登録に関するapiを呼び出してくる 
// 書き方は,Login.vueを参照すること

const category_items = ref([
  '高校生', 
  '大学生', 
  '大学院生', 
  'OB', 
  '大学教職員', 
  'その他'
]);
const faculty_items = ref([
  '総合科学部',
  '文学部', 
  '教育学部', 
  '法学部', 
  '経済学部', 
  '理学部',
  '医学部', 
  '歯学部', 
  '薬学部', 
  '工学部', 
  '生物生産学部',
  '情報科学部',  
  '人間社会科学研究科', 
  '先進理工系科学研究科', 
  '統合生命科学研究科', 
  '医系科学研究科', 
  'スマートソサエティ実践科学研究院',
  '特別支援教育特別専攻科', 
  'その他'
]);
const department_items = ref([
  // faculty_itemsに合わせて変化させる. 
]);
const admission_year_items = ref([
  2017, 
  2018, 
  2019, 
  2020, 
  2021, 
  2022, 
  2023, 
  2024,
]);

const updateDepartmentItems = () => {
  //選択された faculty に合わせて department_items の選択肢を変化させる
  console.log("アップデートされたで");
  if(faculty.value === '総合科学部') {
    department_items.value = ['総合科学科', '国際共創学科', 'その他'];
    console.log( department_items.value);
  } else if (faculty.value === '文学部') {
    department_items.value = ['人文学科', 'その他'];
    console.log( department_items.value);
  } else if (faculty.value === '教育学部') {
    department_items.value = ['a', 'その他'];
    console.log( department_items.value);
  } else if (faculty.value === '法学部') {
    department_items.value = ['法学科', 'その他'];
    console.log( department_items.value);
  } else if (faculty.value === '経済学部') {
    department_items.value = ['b', 'その他'];
    console.log( department_items.value);
  } else if (faculty.value === '理学部') {
    department_items.value = ['c', 'その他'];
    console.log( department_items.value);
  } else if (faculty.value === '医学部') {
    department_items.value = ['d', 'その他'];
    console.log( department_items.value);
  } else if (faculty.value === '歯学部') {
    department_items.value = ['e', 'その他'];
    console.log( department_items.value);
  } else if (faculty.value === '薬学部') {
    department_items.value = ['f', 'その他'];
    console.log( department_items.value);
  } else {
    department_items.value = [''];
    console.log( department_items.value);
  }
    department.value = null; // 子コンボボックスの選択をリセット
};

const clickButton = async() => {
  console.log("クリックされたで");

  const data = {
    user_name:user_name.value,
    user_email:user_email.value,
    password:password.value,
    university_name:"広島大学",
    category:category.value,
    faculty:faculty.value,
    department:department.value,
    admission_year:admission_year.value,
  }

  //   await axios.post("/api/register", data)
  //   .then((response) => {
  //     // ちゃんと送信できたか確認用
  //     // console.log(response.data.success);
  //     // if(response.data.success){
  //       // } 
      //   store.dispatch('login', data);
  //       router.push('/profile')
  //   })
  //   .catch((err) => {
  //     console.log(err);
  //   });  
  try {
      const response = await axios.post("/api/register", data);
      console.log("response")
      // console.log(response)
      // console.log(response.data.id)
      data['id'] = response.data.id;
      data['role'] = response.data.role;
      // console.log(data['role'])
      store.dispatch('login', data);
      router.push('/profile')

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
                      v-model="user_name"
                      label="名前"
                      name="user_name"
                      placeholder="広島 かえで"
                      type="name"
                      clearable
                    ></v-text-field>
                    <v-text-field
                      v-model="user_email"
                      label="メールアドレス"
                      name="user_email"
                      placeholder="Kaede@xxx.com"
                      type="email"
                      clearable
                    ></v-text-field>
                    <v-text-field
                      v-model="password"
                      label="パスワード"
                      name="password"
                      type="password"
                      clearable
                    ></v-text-field>
                    <v-select
                      v-model="category"
                      :items="category_items"
                      label="所属"
                      name="category"
                      type="text"
                    ></v-select>
                    <v-select
                      v-model="faculty"
                      :items="faculty_items"
                      label="学部・研究科"
                      name="faculty"
                      type="text"
                      @update="updateDepartmentItems"
                    ></v-select>
                    <v-select
                      v-model="department"
                      :items="department_items"
                      label="学科・学類・専攻など"
                      name="department"
                      type="text"
                    ></v-select>
                    <v-select
                      v-model="admission_year"
                      :items="admission_year_items"
                      label="入学年度"
                      name="admission_year"
                      type="number"
                    ></v-select>
                    <v-btn @click="clickButton">送信</v-btn>
                </v-form>
            </v-container>
        <!-- </v-main> -->
    </v-app>
</template>