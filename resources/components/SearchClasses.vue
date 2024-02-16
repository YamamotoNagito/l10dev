<script setup>
  import { ref, watch, onMounted } from "vue";
  import { useRouter } from "vue-router";
  import axios from "axios";

  const router = useRouter();
  // どっちのタブを開くのか，情報を格納する変数
  const tab = ref(null);

  // 条件で検索する際はこのデータをバックに送る
  const detailedCondition = ref({
    lectureName: null,
    teacherName: null,
    location: null,
    faculty: null,
    category: null,
    term: null,
    dayOfWeek: null,
    timePeriod: null,
    grade: null,
    totalEvaluation: {
      min: null,
      max: null
    },
    creditLevel: {
      min: null,
      max: null
    },
    interestLevel: {
      min: null,
      max: null
    },
    skillLevel: {
      min: null,
      max: null
    }
  });
  // プルダウン内の文字列（1未満，など）これはupdateEvaluationObject関数で適切なオブジェクトに変換される
  const totalEvaluationString = ref(null);
  const creditLevelString = ref(null);
  const interestLevelString = ref(null);
  const skillLevelString = ref(null);

  // プルダウン内の文字列から，minとmaxをキーにもつオブジェクトを生成し，そのオブジェクトを返す関数
  const updateEvaluationObject = (evaluationString) => {
    const evaluationObj = {};
    switch (evaluationString) {
      case "1未満":
        evaluationObj.min = 0;
        evaluationObj.max = 1;
        break;
      case "1以上":
        evaluationObj.min = 1;
        evaluationObj.max = 2;
        break;
      case "2以上":
        evaluationObj.min = 2;
        evaluationObj.max = 3;
        break;
      case "3以上":
        evaluationObj.min = 3;
        evaluationObj.max = 4;
        break;
      case "4以上":
        evaluationObj.min = 4;
        evaluationObj.max = 5;
        break;

      default:
        // デフォルトの処理はnullになる
        evaluationObj.min = null;
        evaluationObj.max = null;
        break;
    }
    return evaluationObj;
  };

  // TODO
  // 検索項目はフロントでもつ
  // 評価を3つに絞る
  // minとmaxを持たせる
  const locationList = ["東広島", "霞", "東千田", "双方向"];
  const facultyList = [
    "教養教育",
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
    "大学院共通教育",
    "人間社会科学研究科",
    "先進理工系科学研究科",
    "統合生命科学研究科",
    "医系科学研究科",
    "スマートソサエティ実践科学研究科",
    "特別支援教育特別専攻科",
    "教育学研究科",
    "理学研究科",
    "医歯薬保健学研究科",
    "外国語教育センター",
    "総合博物館",
    "ライティングセンター"
  ];
  const categoryList = [
    "大学教育入門",
    "展開ゼミ",
    "平和科目",
    "外国語科目",
    "情報・データサイエンス科目",
    "領域科目",
    "基盤科目",
    "社会連携科目",
    "健康スポーツ科目",
    "専門教育科目",
    "大学院共通科目",
    "専門的教育科目",
    "他学部・他研究科科目"
  ];
  const termList = ["1T", "2T", "3T", "4T", "集中", "前期", "後期", "通年"];
  const dayOfWeekList = ["月", "火", "水", "木", "金"];
  const timePeriodList = ["1コマ", "2コマ", "3コマ", "4コマ", "5コマ", "6コマ", "7コマ"];
  const gradeList = ["B1", "B2", "B3", "B4", "B5"];
  const totalEvaluationList = ["1未満", "1以上", "2以上", "3以上", "4以上"];
  //講義コードで検索する際はこのデータをバックに送る
  const searchClassByLectureCode = ref({
    lectureCode: null
  });

  // 講義コードで検索するタブのメッセージ
  const messageInLectureCodeTab = ref("");
  // 条件で検索するタブのメッセージ
  const messageInConditionalTab = ref("");

  // オブジェクトからvalueがNULLのkeyとvalueのペアを削除する関数
  function removeNullValues(obj) {
    const result = {};

    for (const key in obj) {
      const value = obj[key];

      if (value !== null) {
        result[key] = value;
      }
    }

    return result;
  }

  // 条件で検索するボタンが押されたときに発火する関数
  //検索条件を/class（classListView.vue）のpath内のクエリとして，router.pushされた後はそのqueryをClassListView.vueが受け取って処理する
  const sendQueryToClassListView = async () => {
    // メッセージを更新して空に
    messageInConditionalTab.value = "";
    if (
      //バリデーションチェック(どれか1つでも入力していたら(nullでなければ)通過)
      detailedCondition.value.lectureName == null &&
      detailedCondition.value.teacherName == null &&
      detailedCondition.value.location == null &&
      detailedCondition.value.faculty == null &&
      detailedCondition.value.category == null &&
      detailedCondition.value.term == null &&
      detailedCondition.value.dayOfWeek == null &&
      detailedCondition.value.timePeriod == null &&
      detailedCondition.value.grade == null &&
      totalEvaluationString.value == null &&
      creditLevelString.value == null &&
      interestLevelString.value == null &&
      skillLevelString.value == null
    ) {
      //バリデーションが通らなかったときに実行
      messageInConditionalTab.value = "検索する条件を入力してください";
      // console.log(
      //   'バリデーション通過ならず',
      //   "lectureName: ",detailedCondition.value.lectureName,  '\n',
      //   "teacherName: ",detailedCondition.value.teacherName, '\n',
      //   "location: ",detailedCondition.value.location, '\n',
      //   "faculty: ",detailedCondition.value.faculty, '\n',
      //   "category: ",detailedCondition.value.category, '\n',
      //   "term: ",detailedCondition.value.term, '\n',
      //   "dayOfWeek: ",detailedCondition.value.dayOfWeek, '\n',
      //   "timePeriod: ",detailedCondition.value.timePeriod, '\n',
      //   "grade: ",detailedCondition.value.grade, '\n',
      //   "totalEvaluationString: ",totalEvaluationString.value, '\n',
      //   "creditLevelString: ",creditLevelString.value, '\n',
      //   "interestLevelString: ",interestLevelString.value, '\n',
      //   "skillLevelString: ",skillLevelString.value,
      // );
    } else {
      //バリデーション通過時に実行

      // console.log(
      //   "バリデーション通過！！",
      //   "lectureName: ",detailedCondition.value.lectureName, '\n',
      //   "teacherName: ",detailedCondition.value.teacherName, '\n',
      //   "location: ",detailedCondition.value.location, '\n',
      //   "faculty: ",detailedCondition.value.faculty, '\n',
      //   "category: ",detailedCondition.value.category, '\n',
      //   "term: ",detailedCondition.value.term, '\n',
      //   "dayOfWeek: ",detailedCondition.value.dayOfWeek, '\n',
      //   "timePeriod: ",detailedCondition.value.timePeriod, '\n',
      //   "grade: ",detailedCondition.value.grade, '\n',
      //   "totalEvaluationString: ",totalEvaluationString.value, '\n',
      //   "creditLevelString: ",creditLevelString.value, '\n',
      //   "interestLevelString: ",interestLevelString.value, '\n',
      //   "skillLevelString: ",skillLevelString.value,
      // );
      // プルダウンの文字列からオブジェクトを生成し，datailedConditionに格納する
      detailedCondition.value.totalEvaluation = updateEvaluationObject(totalEvaluationString.value);
      detailedCondition.value.creditLevel = updateEvaluationObject(creditLevelString.value);
      detailedCondition.value.interestLevel = updateEvaluationObject(interestLevelString.value);
      detailedCondition.value.skillLevel = updateEvaluationObject(skillLevelString.value);

      const query = {
        lectureName: detailedCondition.value.lectureName,
        teacherName: detailedCondition.value.teacherName,
        location: detailedCondition.value.location,
        faculty: detailedCondition.value.faculty,
        category: detailedCondition.value.category,
        term: detailedCondition.value.term,
        dayOfWeek: detailedCondition.value.dayOfWeek,
        timePeriod: detailedCondition.value.timePeriod,
        grade: detailedCondition.value.grade,
        totalEvaluationMin: detailedCondition.value.totalEvaluation.min,
        totalEvaluationMax: detailedCondition.value.totalEvaluation.max,
        creditLevelMin: detailedCondition.value.creditLevel.min,
        creditLevelMax: detailedCondition.value.creditLevel.max,
        interestLevelMin: detailedCondition.value.interestLevel.min,
        interestLevelMax: detailedCondition.value.interestLevel.max,
        skillLevelMin: detailedCondition.value.skillLevel.min,
        skillLevelMax: detailedCondition.value.skillLevel.max
      };
      // クエリからNULLをなくす
      const filteredQuery = removeNullValues(query);

      router.push({
        path: "/class",
        query: filteredQuery
      });
    }
  };

  // 講義コードで検索する際に発火する関数
  const searchByLectureCode = async () => {
    try {
      const response = await axios.post("/api/hasLectureCode", searchClassByLectureCode.value);
      console.log("response");
      console.log(response);
      if (response.data.success) {
        messageInLectureCodeTab.value = "";
        const lectureId = response.data.lectureId;
        router.push({ path: `class/${lectureId}/detail` }, { params: lectureId });
      } else {
        messageInLectureCodeTab.value = "存在しない講義コードです．";
      }

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

  // ここから検索候補を表示する機能に関するコード
  const candidateConditionsList = ref([]);
  //
  const fetchData = async () => {
    try {
      const response = await axios.get("/api/getLectureInfo");
      console.log("response from get lecture info : 検索候補のデータ");
      console.log(response);
      // 検索候補をバックエンドから取得して格納
      candidateConditionsList.value = response.data; // 仮に response.data が候補条件のリストであると仮定
      makeDefaultCandidateLectureNameList();
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

  onMounted(() => {
    fetchData();
  });

  const filteredCandidateConditionsList = ref([]);
  const candidateLectureNameList = ref([]);
  const candidateTeacherNameList = ref([]);

  const filterCandidateConditions = () => {
    const detailedLectureName = detailedCondition.value.lectureName
      ? detailedCondition.value.lectureName.toLowerCase()
      : "";
    const detailedTeacherName = detailedCondition.value.teacherName
      ? detailedCondition.value.teacherName.toLowerCase()
      : "";

    filteredCandidateConditionsList.value = candidateConditionsList.value.filter((item) => {
      const lowerCaseLectureName = item.lectureName.toLowerCase();
      const lowerCaseTeacherName = item.teacherName.toLowerCase();

      return lowerCaseLectureName.includes(detailedLectureName) && lowerCaseTeacherName.includes(detailedTeacherName);
    });
  };

  // detailedCondition.value.lectureNameまたはdetailedCondition.value.teacherNameが変化したら実行
  watch([() => detailedCondition.value.lectureName, () => detailedCondition.value.teacherName], () => {
    if (detailedCondition.value.lectureName === null && detailedCondition.value.teacherName === null) {
      candidateLectureNameList.value = [];
      candidateTeacherNameList.value = [];
    } else {
      filterCandidateConditions();
    }
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
    candidateLectureNameList.value = [];
    candidateTeacherNameList.value = [];
  };
</script>

<template>
  <v-container class="mb-16">
    <v-row justify="center">
      <v-card width="900px">
        <v-tabs v-model="tab" align-tabs="center" bg-color="orange-darken-1" height="60px">
          <v-tab value="one" class="tab-name">条件で探す</v-tab>
          <v-tab value="two" class="tab-name">講義コードで探す</v-tab>
        </v-tabs>

        <v-card-text>
          <v-window v-model="tab">
            <v-window-item value="one">
              <v-container class="category-name-and-content-container">
                <p class="category-name">授業名</p>
                <v-combobox
                  v-model="detailedCondition.lectureName"
                  clearable
                  placeholder="一攫千金特論"
                  :items="candidateLectureNameList"
                ></v-combobox>
              </v-container>
              <v-container class="category-name-and-content-container">
                <p class="category-name">担当教員名</p>
                <v-combobox
                  v-model="detailedCondition.teacherName"
                  clearable
                  placeholder="服部淳生"
                  :items="candidateTeacherNameList"
                ></v-combobox>
              </v-container>
              <!-- 他の条件についても同様にコードを追加 -->

              <v-expansion-panels class="mb-4">
                <v-expansion-panel>
                  <v-expansion-panel-title>より詳しい条件で探す</v-expansion-panel-title>
                  <v-expansion-panel-text>
                    <v-container class="detailed-totalEvaluationList-list-container">
                      <!-- 以下、他の条件の追加 -->
                      <v-container class="category-name-and-content-container">
                        <p class="category-name">開講場所</p>
                        <v-select
                          v-model="detailedCondition.location"
                          :items="locationList"
                          class="pulldown-list"
                          clearable
                        ></v-select>
                      </v-container>

                      <v-container class="category-name-and-content-container">
                        <p class="category-name">開講部局</p>
                        <v-select
                          v-model="detailedCondition.faculty"
                          :items="facultyList"
                          class="pulldown-list"
                          clearable
                        ></v-select>
                      </v-container>

                      <v-container class="category-name-and-content-container">
                        <p class="category-name">開講区分</p>
                        <v-select
                          v-model="detailedCondition.category"
                          :items="categoryList"
                          class="pulldown-list"
                          clearable
                        ></v-select>
                      </v-container>

                      <v-container class="category-name-and-content-container">
                        <p class="category-name">ターム</p>
                        <v-select
                          v-model="detailedCondition.term"
                          :items="termList"
                          class="pulldown-list"
                          clearable
                        ></v-select>
                      </v-container>

                      <v-container class="category-name-and-content-container">
                        <p class="category-name">曜日</p>
                        <v-select
                          v-model="detailedCondition.dayOfWeek"
                          :items="dayOfWeekList"
                          class="pulldown-list"
                          clearable
                        ></v-select>
                      </v-container>

                      <v-container class="category-name-and-content-container">
                        <p class="category-name">時間</p>
                        <v-select
                          v-model="detailedCondition.timePeriod"
                          :items="timePeriodList"
                          class="pulldown-list"
                          clearable
                        ></v-select>
                      </v-container>

                      <v-container class="category-name-and-content-container">
                        <p class="category-name">履修年次</p>
                        <v-select
                          v-model="detailedCondition.grade"
                          :items="gradeList"
                          class="pulldown-list"
                          clearable
                        ></v-select>
                      </v-container>

                      <v-container class="category-name-and-content-container">
                        <p class="category-name">総合評価</p>
                        <v-select
                          v-model="totalEvaluationString"
                          :items="totalEvaluationList"
                          class="pulldown-list"
                          clearable
                        ></v-select>
                      </v-container>

                      <v-container class="category-name-and-content-container">
                        <p class="category-name">単位取得のしやすさ</p>
                        <v-select
                          v-model="creditLevelString"
                          :items="totalEvaluationList"
                          class="pulldown-list"
                          clearable
                        ></v-select>
                      </v-container>

                      <v-container class="category-name-and-content-container">
                        <p class="category-name">面白さ</p>
                        <v-select
                          v-model="interestLevelString"
                          :items="totalEvaluationList"
                          class="pulldown-list"
                          clearable
                        ></v-select>
                      </v-container>

                      <v-container class="category-name-and-content-container">
                        <p class="category-name">スキルが身につくか</p>
                        <v-select
                          v-model="skillLevelString"
                          :items="totalEvaluationList"
                          class="pulldown-list"
                          clearable
                        ></v-select>
                      </v-container>
                      <!-- 他の条件の追加ここまで -->
                    </v-container>
                  </v-expansion-panel-text>
                </v-expansion-panel>
              </v-expansion-panels>

              <p class="text-red text-center">{{ messageInConditionalTab }}</p>
              <v-btn color="orange-darken-1" @click="sendQueryToClassListView">
                <v-icon start icon="mdi-checkbox-marked-circle"></v-icon>検索
              </v-btn>
            </v-window-item>

            <v-window-item value="two">
              <v-container class="category-and-content-container">
                <p class="category-name">講義コード</p>
                <v-text-field
                  v-model="searchClassByLectureCode.lectureCode"
                  placeholder="KA*******"
                  clearable
                ></v-text-field>
              </v-container>
              <v-container class="d-flex">
                <v-btn color="orange-darken-1" @click="searchByLectureCode">
                  <v-icon start icon="mdi-checkbox-marked-circle"></v-icon>検索
                </v-btn>
                <p class="text-red text-center">
                  {{ messageInLectureCodeTab }}
                </p>
              </v-container>
            </v-window-item>
          </v-window>
        </v-card-text>
      </v-card>
    </v-row>
  </v-container>
</template>

<style scoped>
  .category-name {
    font-size: 1.3rem;
  }
  .tab-name {
    font-size: 1.3rem;
  }
</style>
