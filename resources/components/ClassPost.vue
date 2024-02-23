<template>
  <v-row justify="center">
    <v-col cols="8">
      <v-row>
        <v-col>
          <p class="text-h6">授業名</p>
          <v-autocomplete
            v-model="lectureName"
            placeholder="一攫千金特論"
            class="input-field"
            :items="candidateLectureNameList"
            :error-messages="v$.lectureName.$error ? ['授業名を入力してください. '] : []"
            clearable
            variant="outlined"
          ></v-autocomplete>
          <p class="text-h6">担当教員名</p>
          <v-autocomplete
            v-model="teacherName"
            placeholder="服部淳生"
            class="input-field"
            :items="candidateTeacherNameList"
            :error-messages="v$.teacherName.$error ? ['教員名を入力してください. '] : []"
            clearable
            variant="outlined"
          ></v-autocomplete>
        </v-col>
      </v-row>
      <!-- 受講年度 -->
      <v-row>
        <v-col>
          <!-- sm(600px)未満の場合でも文字サイズが小さくなる？ -->
          <p class="custom-text-style">履修年度</p>
        </v-col>
      </v-row>
      <v-btn-toggle v-model="attendanceYear" variant="outlined" class="full-height">
        <v-row no-gutters class="my-2">
          <v-col v-for="option in attendanceYearOptions" :key="option.value" cols="4" sm="2" md="2" lg="" xl="">
            <v-btn :value="option.value" :size="btnSize" rounded="xl" class="ml-0" color="primary">
              {{ option.label }}
            </v-btn>
          </v-col>
        </v-row>
      </v-btn-toggle>
      <!-- 出席の有無 -->
      <v-row class="mt-5">
        <v-col>
          <p class="custom-text-style">出席確認の有無</p>
        </v-col>
      </v-row>
      <v-btn-toggle v-model="attendanceConfirm" variant="outlined" class="full-height">
        <v-row no-gutters class="my-2">
          <v-col v-for="option in attendanceConfirmOptions" :key="option.value" cols="4" sm="" md="" lg="" xl="">
            <v-btn :value="option.value" :size="btnSize" rounded="xl" class="ml-0" color="primary">
              {{ option.label }}
            </v-btn>
          </v-col>
        </v-row>
      </v-btn-toggle>
      <!-- 毎回のレポート・テスト -->
      <v-row class="mt-5">
        <v-col>
          <p class="custom-text-style">毎回のレポート・テスト</p>
        </v-col>
      </v-row>
      <v-btn-toggle v-model="weeklyAssignments" variant="outlined" class="full-height">
        <v-row no-gutters class="my-2">
          <v-col v-for="option in weeklyAssignmentsOptions" :key="option.value" cols="" sm="" md="" lg="">
            <v-btn :value="option.value" rounded="xl" class="ml-0" color="primary">
              {{ option.label }}
            </v-btn>
          </v-col>
        </v-row>
      </v-btn-toggle>
      <!-- 中間のレポート・テスト -->
      <v-row class="mt-5">
        <v-col>
          <p class="custom-text-style">中間のレポート・テスト</p>
        </v-col>
      </v-row>
      <v-btn-toggle v-model="midtermAssignments" variant="outlined" class="full-height">
        <v-row no-gutters class="my-2">
          <v-col v-for="option in midtermAssignmentsOptions" :key="option.value" cols="" sm="" md="" lg="">
            <v-btn :value="option.value" rounded="xl" class="ml-0" color="primary">
              {{ option.label }}
            </v-btn>
          </v-col>
        </v-row>
      </v-btn-toggle>
      <!-- 期末のレポート・テスト -->
      <v-row class="mt-5">
        <v-col>
          <p class="custom-text-style">期末のレポート・テスト</p>
        </v-col>
      </v-row>
      <v-btn-toggle v-model="finalAssignments" variant="outlined" class="full-height">
        <v-row no-gutters class="my-2">
          <v-col v-for="option in finalAssignmentsOptions" :key="option.value" cols="" sm="" md="" lg="">
            <v-btn :value="option.value" rounded="xl" class="ml-0" color="primary">
              {{ option.label }}
            </v-btn>
          </v-col>
        </v-row>
      </v-btn-toggle>
      <!-- 過去問・レポートの有無 -->
      <v-row class="mt-5">
        <v-col>
          <p class="custom-text-style">過去問・レポートの所持</p>
        </v-col>
      </v-row>
      <v-btn-toggle v-model="pastExamPossession" variant="outlined" class="full-height">
        <v-row no-gutters class="my-2">
          <v-col v-for="option in pastExamPossessionOptions" :key="option.value" cols="" sm="" md="" lg="">
            <v-btn :value="option.value" rounded="xl" class="ml-0" color="primary">
              {{ option.label }}
            </v-btn>
          </v-col>
        </v-row>
      </v-btn-toggle>
      <!-- 成績 -->
      <v-row class="mt-5">
        <v-col>
          <p class="custom-text-style">成績</p>
        </v-col>
      </v-row>
      <v-btn-toggle v-model="grades" variant="outlined" class="full-height">
        <v-row no-gutters class="my-2">
          <v-col v-for="option in gradesOptions" :key="option.value" cols="" sm="" md="" lg="">
            <v-btn :value="option.value" rounded="xl" class="ml-0" color="primary">
              {{ option.label }}
            </v-btn>
          </v-col>
        </v-row>
      </v-btn-toggle>
      <!-- 単位取得のしやすさ -->
      <v-row class="mt-5">
        <v-col>
          <p class="custom-text-style">単位取得のしやすさ</p>
        </v-col>
      </v-row>
      <v-btn-toggle v-model="creditLevel" variant="outlined" class="full-height">
        <v-row no-gutters class="my-2">
          <v-col v-for="option in creditLevelOptions" :key="option.value" cols="" sm="" md="" lg="">
            <v-btn :value="option.value" rounded="xl" class="ml-0" color="primary">
              {{ option.label }}
            </v-btn>
          </v-col>
        </v-row>
      </v-btn-toggle>
      <!-- 面白さ -->
      <v-row class="mt-5">
        <v-col>
          <p class="custom-text-style">面白さ</p>
        </v-col>
      </v-row>
      <v-btn-toggle v-model="interestLevel" variant="outlined" class="full-height">
        <v-row no-gutters class="my-2">
          <v-col v-for="option in interestLevelOptions" :key="option.value" cols="" sm="" md="" lg="">
            <v-btn :value="option.value" rounded="xl" class="ml-0" color="primary">
              {{ option.label }}
            </v-btn>
          </v-col>
        </v-row>
      </v-btn-toggle>
      <!-- スキル習得 -->
      <v-row class="mt-5">
        <v-col>
          <p class="custom-text-style">スキル習得</p>
        </v-col>
      </v-row>
      <v-btn-toggle v-model="skillLevel" variant="outlined" class="full-height">
        <v-row no-gutters class="my-2">
          <v-col v-for="option in skillLevelOptions" :key="option.value" cols="" sm="" md="" lg="">
            <v-btn :value="option.value" rounded="xl" class="ml-0" color="primary">
              {{ option.label }}
            </v-btn>
          </v-col>
        </v-row>
      </v-btn-toggle>
      <!-- コメント -->
      <v-row class="mt-5">
        <v-col>
          <p class="custom-text-style">コメント</p>
        </v-col>
      </v-row>
      <v-row>
        <v-col>
          <v-textarea
            v-model="comments"
            variant="outlined"
            :error-messages="v$.comments.$error ? ['入力内容は2000文字以内にしてください. '] : []"
            auto-grow
            placeholder="例：この授業はどんな人におすすめか，過去問は役に立ったか，など"
          ></v-textarea>
        </v-col>
      </v-row>

      <v-alert v-if="errorMessage" type="error" variant="tonal" class="mb-6">{{ errorMessage }}</v-alert>
      <v-row>
        <v-col class="text-center custom-text-style">
          <v-btn text="投稿する" color="primary" @click="clickButton"></v-btn>
        </v-col>
      </v-row>
    </v-col>
  </v-row>
</template>

<script setup>
  import { ref, onMounted, watch } from "vue";
  import axios from "axios";
  import { useRouter } from "vue-router";
  import { computed } from "vue";
  import { useDisplay } from "vuetify";
  import { useStore } from "vuex";
  import { useVuelidate } from "@vuelidate/core";
  import { required, maxLength } from "@vuelidate/validators";

  const store = useStore();

  // 授業名と担当教員名を宣言・デフォルト値はnullにしておく
  const lectureName = ref(null);
  const teacherName = ref(null);

  // router.currentRoute.value.queryに授業名と担当教員名が入っているはず
  const router = useRouter();

  const errorMessage = ref(""); // エラーメッセージ用の変数

  const attendanceYear = ref(2024);
  const attendanceYearOptions = ref([
    { label: 2024, value: 2024 },
    { label: 2023, value: 2023 },
    { label: 2022, value: 2022 },
    { label: 2021, value: 2021 },
    { label: 2020, value: 2020 },
    { label: 2019, value: 2019 },
    { label: 2018, value: 2018 },
    { label: 2017, value: 2017 },
    // その他の場合は -1 として扱う
    { label: "その他", value: -1 }
  ]);

  const attendanceConfirm = ref("なし");
  const attendanceConfirmOptions = ref([
    { label: "なし", value: "なし" },
    { label: "毎回", value: "毎回" },
    { label: "たまに", value: "たまに" }
  ]);

  const weeklyAssignments = ref("なし");
  const weeklyAssignmentsOptions = ref([
    { label: "なし", value: "なし" },
    { label: "レポートのみ", value: "レポート" },
    { label: "テストのみ", value: "テスト" },
    { label: "レポート&テスト", value: "レポテス" }
  ]);

  const midtermAssignments = ref("なし");
  const midtermAssignmentsOptions = ref([
    { label: "なし", value: "なし" },
    { label: "レポートのみ", value: "レポート" },
    { label: "テストのみ", value: "テスト" },
    { label: "レポート&テスト", value: "レポテス" }
  ]);

  const finalAssignments = ref("なし");
  const finalAssignmentsOptions = ref([
    { label: "なし", value: "なし" },
    { label: "レポートのみ", value: "レポート" },
    { label: "テストのみ", value: "テスト" },
    { label: "レポート&テスト", value: "レポテス" }
  ]);

  // valueは文字列として受け渡しをするので、+を用いたくない
  const pastExamPossession = ref("なし");
  const pastExamPossessionOptions = ref([
    { label: "なし", value: "なし" },
    { label: "過去問＋過去レポート", value: "レポ問" },
    { label: "過去問のみ", value: "過去問" },
    { label: "過去レポートのみ", value: "過去レポート" }
  ]);

  const grades = ref("良");
  const gradesOptions = ref([
    { label: "秀", value: "秀" },
    { label: "優", value: "優" },
    { label: "良", value: "良" },
    { label: "可", value: "可" },
    { label: "不可", value: "不可" },
    { label: "未定", value: "未定" }
  ]);

  const creditLevel = ref(3);
  const creditLevelOptions = ref([
    { label: "激難", value: 1 },
    { label: "難", value: 2 },
    { label: "普通", value: 3 },
    { label: "楽", value: 4 },
    { label: "超楽", value: 5 }
  ]);

  const interestLevel = ref(3);
  const interestLevelOptions = ref([
    { label: "まったく面白くない", value: 1 },
    { label: "面白くない", value: 2 },
    { label: "普通", value: 3 },
    { label: "面白い", value: 4 },
    { label: "とても面白い", value: 5 }
  ]);

  const skillLevel = ref("3");
  const skillLevelOptions = ref([
    { label: "まったく役に立たない", value: "1" },
    { label: "あまり役に立たない", value: "2" },
    { label: "普通", value: "3" },
    { label: "役立つ", value: "4" },
    { label: "とても役立つ", value: "5" }
  ]);

  const comments = ref("");

  // 画面サイズに合わせてボタンのサイズを返す
  const { name } = useDisplay();
  const btnSize = computed(() => {
    switch (name.value) {
      case "xs":
        return "small";
      case "sm":
        return "small";
      case "md":
        return "default";
      case "lg":
        return "default";
      case "xl":
        return "default";
      case "xxl":
        return "default";
    }
    return "default";
  });

  // バリデーションルール
  const rules = {
    lectureName: { required },
    teacherName: { required },
    comments: { maxLength: maxLength(2000) }
  };
  const v$ = useVuelidate(rules, { lectureName, teacherName, comments });

  // 送信後、フォームのカテゴリとメッセージをリセットする
  const resetForm = () => {
    lectureName.value = "";
    teacherName.value = "";
    comments.value = "";
    v$.value.$reset(); // バリデーション状態のリセット
  };

  const clickButton = async () => {
    console.log("クリックされたで");
    console.log(store.getters.userInfo.id);

    // バリデーションチェック
    v$.value.$validate();
    if (!v$.value.$invalid) {
      //バリデーション通過したら実行
      const data = {
        // lecture_id: 1,
        userId: store.getters.userInfo.id,
        lectureName: lectureName.value,
        teacherName: teacherName.value,
        attendanceYear: attendanceYear.value,
        attendanceConfirm: attendanceConfirm.value,
        weeklyAssignments: weeklyAssignments.value,
        midtermAssignments: midtermAssignments.value,
        finalAssignments: finalAssignments.value,
        pastExamPossession: pastExamPossession.value,
        grades: grades.value,
        creditLevel: creditLevel.value,
        interestLevel: interestLevel.value,
        skillLevel: skillLevel.value,
        comments: comments.value
      };

      try {
        const response = await axios.post("/api/reviews", data);
        console.log("response");

        if (response.data.success) {
          // router.push('/reviews');
          // フォームのリセット
          resetForm();
          errorMessage.value = "";
        } else {
          errorMessage.value = response.data.message;
        }

        // その他の処理
      } catch (error) {
        errorMessage.value = "レビューを投稿できませんでした。時間をおいて再度お試しください。";
        if (error.response) {
          // サーバーからのエラーレスポンスがある場合
          console.error(error.response.data); // エラーレスポンスをコンソールに出力
          errorMessage.value = error.response.data?.message;
        } else {
          // リクエストがサーバーに届かなかった場合など
          errorMessage.value = "レビューを投稿できませんでした。時間をおいて再度お試しください。";
        }
      }
    }
  };

  // ページが読み込まれたときに，デフォルトで表示するlectureNameとteacherNameを取得
  // 検索候補を取得
  onMounted(async () => {
    await fetchCandidateConditionsList(); // 非同期処理のため `await` を追加
    receiveQueryParameters(); // fetchCandidateConditionsList関数の後に実行
  });

  // queryの中にある授業名と担当教員名を取得する関数．
  // onMounted時に発火する
  const receiveQueryParameters = () => {
    // $route.query から lectureName と teacherName を取得
    const queryLectureName = router.currentRoute.value.query.lectureName;
    const queryTeacherName = router.currentRoute.value.query.teacherName;

    // candidateConditionsList内にペアがあるか確認
    const hasPair = candidateConditionsList.value.some(
      (pair) => pair.lectureName === queryLectureName && pair.teacherName === queryTeacherName
    );

    // ペアがあれば設定、なければnull
    lectureName.value = hasPair ? queryLectureName : null;
    teacherName.value = hasPair ? queryTeacherName : null;

    // 何かしらの処理（例: ログ出力）
    console.log("Received query parameters - Lecture Name:", lectureName.value, "Teacher Name:", teacherName.value);
  };

  // ここから検索候補を表示する機能に関するコード
  const candidateConditionsList = ref([]);
  //
  const fetchCandidateConditionsList = async () => {
    try {
      const response = await axios.get("/api/getLectureInfo");
      console.log("response");
      console.log(response);
      // 検索候補をバックエンドから取得して格納
      candidateConditionsList.value = response.data; // 仮に response.data が候補条件のリストであると仮定
      makeDefaultCandidateLectureNameList();
    } catch (error) {
      if (error?.response?.data) {
        // サーバーからのエラーレスポンスがある場合
        errorMessage.value = error.response.data?.message;
      } else {
        // リクエストがサーバーに届かなかった場合など
        errorMessage.value =
          "登録できませんでした. サーバーのエラー, または既に使用されているメールアドレスである可能性があります. ";
      }
    }
  };

  const filteredCandidateConditionsList = ref([]);
  const candidateLectureNameList = ref([]);
  const candidateTeacherNameList = ref([]);

  const filterCandidateConditions = () => {
    const detailedLectureName = lectureName.value ? lectureName.value.toLowerCase() : "";
    const detailedTeacherName = teacherName.value ? teacherName.value.toLowerCase() : "";

    filteredCandidateConditionsList.value = candidateConditionsList.value.filter((item) => {
      const lowerCaseLectureName = item.lectureName.toLowerCase();
      const lowerCaseTeacherName = item.teacherName.toLowerCase();

      return lowerCaseLectureName.includes(detailedLectureName) && lowerCaseTeacherName.includes(detailedTeacherName);
    });
  };

  // detailedCondition.value.lectureNameまたはdetailedCondition.value.teacherNameが変化したら実行
  watch([() => lectureName.value, () => teacherName.value], () => {
    filterCandidateConditions();
  });

  // filteredCandidateConditionsListが更新されたら実行
  watch(
    () => filteredCandidateConditionsList.value,
    () => {
      // 値をクリア
      candidateLectureNameList.value = [];
      candidateTeacherNameList.value = [];

      // 更新されたリストを走査して値を抽出
      filteredCandidateConditionsList.value.forEach((item) => {
        candidateLectureNameList.value.push(item.lectureName);
        candidateTeacherNameList.value.push(item.teacherName);
      });

      // 重複を取り除く
      candidateLectureNameList.value = [...new Set(candidateLectureNameList.value)];
      candidateTeacherNameList.value = [...new Set(candidateTeacherNameList.value)];
    }
  );

  // 検索候補の初期設定
  // 今は元からから空の配列になっているが，今後デフォルトの検索候補を出す可能性を考えて関数にした
  const makeDefaultCandidateLectureNameList = () => {
    filterCandidateConditions();
  };
</script>

<style scoped>
  .v-btn {
    margin: 0 10px;
  }
  .full-height {
    height: auto !important;
  }
  .custom-text-style {
    @apply text-md-h5 text-sm-h6;
  }
</style>
