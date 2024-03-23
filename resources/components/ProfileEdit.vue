<script setup>
  import { ref, watch, onMounted, nextTick } from "vue";
  import axios from "axios";
  import { useRouter } from "vue-router";
  import { useStore } from "vuex";
  import { useVuelidate } from "@vuelidate/core";
  import { required, email, maxLength, minLength, sameAs } from "@vuelidate/validators";
  import { useMessage } from "../components/composables/useMessage";
  import CommonAlert from "../components/shared/CommonAlert.vue";

  const router = useRouter();
  const store = useStore();

  const userName = ref("");
  const userEmail = ref("");

  const category = ref("");
  const faculty = ref("");
  const department = ref("");
  const admissionYear = ref("");

  // 初期値を取得する関数
  const fetchInitialValues = async () => {
    try {
      const response = await axios.get("/api/initialValues");
      console.log(response.data);
      const data = response.data;

      userName.value = data.userName;
      userEmail.value = data.userEmail;
      category.value = data.category;

      nextTick(() => {
        // DOM の更新後に行いたい処理を記述
        faculty.value = data.faculty;
        nextTick(() => {
          department.value = data.department;
        });
        admissionYear.value = data.admissionYear;
      });
    } catch (error) {
      console.error("初期値の取得に失敗しました。", error);
    }
  };

  // コンポーネントがマウントされたときに初期値を取得する
  onMounted(() => {
    fetchInitialValues();
  });

  let isStudent = ref(false);

  const { message, messageType, uniqueKey, setErrorMessage } = useMessage();

  // 新規登録に関するapiを呼び出してくる
  // 書き方は,Login.vueを参照すること

  const categoryItems = ref(["高校生", "大学生", "大学院生", "OB", "大学教職員", "その他"]);

  const facultyItems = ref([
    // categoryに合わせて変化させる.
  ]);
  const departmentItems = ref([
    // facultyに合わせて変化させる.
  ]);
  const admissionYearItems = ref([
    // categoryに合わせて変化させる.
  ]);

  const updateIsStudent = () => {
    if (category.value === "大学生" || category.value === "大学院生") {
      isStudent.value = true;
    } else {
      isStudent.value = false;
    }
    // console.log("学生か(isStudent): ", isStudent);
  };

  const updateFacultyItems = () => {
    // console.log("facultyがアップデートされたで");
    faculty.value = null; // 子コンボボックスの選択をリセット
    if (!isStudent.value) {
      // 学部・研究科を「その他」に自動入力
      faculty.value = "その他";
      // console.log("学部(faculty): ", faculty.value);
      // facultyItems.value = ['その他'];
      return;
    } else if (category.value === "大学生") {
      facultyItems.value = [
        "総合科学部",
        "文学部",
        "教育学部",
        "法学部",
        "経済学部",
        "理学部",
        "医学部",
        "歯学部",
        "薬学部",
        "工学部",
        "生物生産学部",
        "情報科学部",
        "その他"
      ];
      return;
    } else if (category.value === "大学院生") {
      facultyItems.value = [
        "人間社会科学研究科",
        "先進理工系科学研究科",
        "統合生命科学研究科",
        "医系科学研究科",
        "スマートソサエティ実践科学研究院",
        "その他"
      ];
      return;
    } else {
      facultyItems.value = [""];
      return;
    }
  };

  const updateAdmissionYearItems = () => {
    // console.log("AdmissionYearがアップデートされたで");
    admissionYear.value = null; // 子コンボボックスの選択をリセット
    if (!isStudent.value) {
      // 入学年度を「その他」に自動入力
      admissionYear.value = "その他";
      // console.log("入学年度(admissionYear):", admissionYear.value);
      // admissionYearItems.value = ['その他'];
      return;
    } else if (isStudent.value) {
      admissionYearItems.value = ["2017", "2018", "2019", "2020", "2021", "2022", "2023", "2024"];
      return;
    } else {
      admissionYearItems.value = [""];
      return;
    }
  };

  const updateDepartmentItems = () => {
    //選択された faculty に合わせて departmentItems の選択肢を変化させる
    // console.log("departmentがアップデートされたで");
    // console.log("現在のfacultyは: ", faculty.value);
    department.value = null; // 子コンボボックスの選択をリセット
    if (faculty.value === "総合科学部") {
      departmentItems.value = ["総合科学科", "国際共創学科", "その他"];
      // console.log( departmentItems.value);
      return;
    } else if (faculty.value === "文学部") {
      departmentItems.value = ["人文学科", "その他"];
      // console.log( departmentItems.value);
      return;
    } else if (faculty.value === "教育学部") {
      departmentItems.value = [
        "学校教育系",
        "科学文化教育系",
        "言語文化教育系",
        "生涯活動教育系",
        "人間形成基礎系",
        "その他"
      ];
      // console.log( departmentItems.value);
      return;
    } else if (faculty.value === "法学部") {
      departmentItems.value = ["法学科", "その他"];
      // console.log( departmentItems.value);
      return;
    } else if (faculty.value === "経済学部") {
      departmentItems.value = ["経済学科", "その他"];
      // console.log( departmentItems.value);
      return;
    } else if (faculty.value === "理学部") {
      departmentItems.value = ["物理学科", "地球惑星システム学科", "生物科学科", "数学科", "化学科", "その他"];
      // console.log( departmentItems.value);
      return;
    } else if (faculty.value === "医学部") {
      departmentItems.value = ["医学科", "保健学科", "その他"];
      // console.log( departmentItems.value);
      return;
    } else if (faculty.value === "歯学部") {
      departmentItems.value = ["歯学科", "口腔健康科学科", "その他"];
      // console.log( departmentItems.value);
      return;
    } else if (faculty.value === "薬学部") {
      departmentItems.value = ["薬学科", "薬科学科", "その他"];
      // console.log( departmentItems.value);
      return;
    } else if (faculty.value === "工学部") {
      departmentItems.value = [
        "第1類(機械・輸送・材料・エネルギー系)",
        "第2類(電気電子・システム情報系)",
        "第3類(応用化学・生物工学・化学工学系)",
        "第4類(建設・環境系)",
        "その他"
      ];
      // console.log( departmentItems.value);
      return;
    } else if (faculty.value === "生物生産学部") {
      departmentItems.value = ["生物生産学科", "その他"];
      // console.log( departmentItems.value);
      return;
    } else if (faculty.value === "情報科学部") {
      departmentItems.value = ["情報科学科", "その他"];
      // console.log( departmentItems.value);
      return;
    } else if (faculty.value === "人間社会科学研究科") {
      departmentItems.value = [
        "人文社会科学専攻",
        "教育科学専攻",
        "教職開発専攻（教職大学院）",
        "実務法学専攻（法科大学院）",
        "国際連携専攻",
        "その他"
      ];
      // console.log( departmentItems.value);
      return;
    } else if (faculty.value === "先進理工系科学研究科") {
      departmentItems.value = ["先進理工系科学専攻", "国際連携専攻", "その他"];
      // console.log( departmentItems.value);
      return;
    } else if (faculty.value === "統合生命科学研究科") {
      departmentItems.value = ["統合生命科学専攻", "その他"];
      // console.log( departmentItems.value);
      return;
    } else if (faculty.value === "医系科学研究科") {
      departmentItems.value = ["医歯薬学専攻", "総合健康科学専攻", "総合健康科学専攻", "その他"];
      // console.log( departmentItems.value);
      return;
    } else if (faculty.value === "スマートソサエティ実践科学研究院") {
      departmentItems.value = ["その他"];
      // departmentItems.value = ['その他'];
      // console.log( departmentItems.value);
      return;
    } else if (faculty.value == "その他") {
      department.value = "その他";
      // console.log("学科(department): ", department.value);
      // departmentItems.value = ['その他'];
      return;
    } else {
      departmentItems.value = [""];
      return;
    }
  };

  watch(category, () => {
    updateIsStudent();
    updateFacultyItems();
    updateAdmissionYearItems();
  });

  // facultyで選択された値が変更されたときに発火する関数
  // その他の変更時の発火処理はwatchを使うこと
  watch(faculty, () => {
    updateDepartmentItems();
  });

  // バリデーションのルール
  const rules = {
    userName: { required, maxLength: maxLength(32) },
    userEmail: { required, email },
    faculty: { required },
    department: { required },
    admissionYear: { required },
    category: { required }
  };

  const v$ = useVuelidate(rules, {
    userName,
    userEmail,
    faculty,
    department,
    admissionYear,
    category
  });

  const clickUpdateButton = async () => {
    // バリデーションチェック
    v$.value.$validate();
    if (!v$.value.$invalid) {
      // バリデーション成功時の処理
      // console.log('バリデーション成功！');

      const data = {
        userName: userName.value,
        userEmail: userEmail.value,
        universityName: "広島大学",
        category: category.value,
        faculty: faculty.value,
        department: department.value,
        admissionYear: admissionYear.value
      };

      try {
        console.log("updateをします");
        await axios.post("/api/update", data);
        store.dispatch("login", data);
        router.push({ name: "profile" });

        // その他の処理
      } catch (error) {
        if (error?.response?.data) {
          // サーバーからのエラーレスポンスがある場合
          setErrorMessage(error.response.data.message);
        } else {
          setErrorMessage(
            "登録できませんでした. サーバーのエラー, または既に使用されているメールアドレスである可能性があります. "
          );
        }
      }
    }
  };
</script>

<template>
  <v-card class="auth-card pa-4 pt-7 mb-15" max-width="500">
    <v-row justify="center" align="center">
      <v-col cols="12" class="d-flex justify-center">
        <v-row>
          <v-form action="" method="post">
            <v-col cols="12">
              <v-card-text class="pt-2">
                <h5 class="text-h5 font-weight-semibold mb-4 text-center">プロフィール編集</h5>
              </v-card-text>
            </v-col>
            <v-col cols="12">
              <v-text-field
                v-model="userName"
                :error-messages="v$.userName.$error ? ['1字以上32字以下の, 名前を入力してください. '] : []"
                label="ユーザー名（本名非推奨）"
                name="userName"
                type="name"
                clearable
                variant="outlined"
              ></v-text-field>
            </v-col>
            <v-col cols="12">
              <v-text-field
                v-model="userEmail"
                :error-messages="v$.userEmail.$error ? ['有効なメールアドレスを入力してください. '] : []"
                label="メールアドレス"
                name="userEmail"
                type="email"
                clearable
                variant="outlined"
              ></v-text-field>
            </v-col>
            <v-col cols="12">
              <v-select
                v-model="category"
                :error-messages="v$.category.$error ? ['所属を選択してください. '] : []"
                :items="categoryItems"
                label="所属"
                name="category"
                type="text"
                variant="outlined"
              ></v-select>
            </v-col>
            <v-col cols="12" v-if="isStudent">
              <v-select
                v-model="faculty"
                :error-messages="v$.faculty.$error ? ['学部・研究科等を選択してください. '] : []"
                :items="facultyItems"
                label="学部・研究科"
                name="faculty"
                type="text"
                variant="outlined"
              ></v-select>
            </v-col>
            <v-col cols="12" v-if="isStudent">
              <v-select
                v-model="department"
                :error-messages="v$.department.$error ? ['学科・類・専攻等を選択してください. '] : []"
                :items="departmentItems"
                label="学科・学類・専攻など"
                name="department"
                type="text"
                variant="outlined"
              ></v-select>
            </v-col>
            <v-col cols="12" v-if="isStudent">
              <v-select
                v-model="admissionYear"
                :error-messages="v$.admissionYear.$error ? ['入学年度を選択してください. '] : []"
                :items="admissionYearItems"
                label="入学年度"
                name="admissionYear"
                type="text"
                variant="outlined"
              ></v-select>
            </v-col>
            <v-col cols="12" class="d-flex justify-center">
              <v-btn color="third ma-auto" @click="router.push({ name: 'profile' })">
                <p class="text-black">キャンセル</p>
              </v-btn>
              <v-btn color="primary ma-auto" @click="clickUpdateButton">
                <p class="text-white">更新する</p>
              </v-btn>
            </v-col>
          </v-form>
        </v-row>
      </v-col>
    </v-row>
  </v-card>
  <common-alert :message="message" :type="messageType" :unique-key="uniqueKey" />
</template>
