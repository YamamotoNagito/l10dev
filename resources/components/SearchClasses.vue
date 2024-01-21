<script setup>
import { ref, computed } from "vue";
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
  categoty: null,
  term: null,
  dayOfWeek: null,
  timePeriod: null,
  grade: null,
  totalEvaluation: {
    min: null,
    max: null,
  },
  creditLevel: {
    min: null,
    max: null,
  },
  interestLevel: {
    min: null,
    max: null,
  },
  skillLevel: {
    min: null,
    max: null,
  },
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
      evaluationObj.min = null
      evaluationObj.max = null
      break;
  }
  console.log(evaluationObj)
  return evaluationObj
};

// TODO
// 検索項目はフロントでもつ
// 評価を3つに絞る
// minとmaxを持たせる
const locationList = ["A", "B", "C", "D"];
const facultyList = ["A", "B", "C", "D"];
const categoryList = ["A", "B", "C", "D"];
const termList = ["A", "B", "C", "D"];
const dayOfWeekList = ["A", "B", "C", "D"];
const timePeriodList = ["A", "B", "C", "D"];
const gradeList = ["A", "B", "C", "D"];
const totalEvaluationList = ["1未満", "1以上", "2以上", "3以上", "4以上"];
//講義コードで検索する際はこのデータをバックに送る
const searchClassByLectureCode = ref({
  lectureCode: null,
});

// 講義コードで検索する際に，一致する講義コードがなかった時に表示するメッセージ
const nonExistenceMessage = ref("");

// 条件で検索するボタンが押されたときに発火する関数
//welcome内の検索機能と一覧内の検索機能を同じにしようとしたら，検索条件を/classに送信して，/class内で検索
const sendQueryToClassListView = async () => {
  // プルダウンの文字列からオブジェクトを生成し，datailedConditionに格納する
  detailedCondition.value.totalEvaluation = updateEvaluationObject(totalEvaluationString.value)
  detailedCondition.value.creditLevel = updateEvaluationObject(creditLevelString.value)
  detailedCondition.value.interestLevel = updateEvaluationObject(interestLevelString.value)  
  detailedCondition.value.skillLevel = updateEvaluationObject(skillLevelString.value)

  console.log(detailedCondition.value);
  router.push({
    path: "/class",
    query: {
      lectureName: detailedCondition.value.lectureName,
      teacherName: detailedCondition.value.teacherName,
      location: detailedCondition.value.location,
      faculty: detailedCondition.value.faculty,
      category: detailedCondition.value.category,
      term: detailedCondition.value.term,
      dayOfWeek: detailedCondition.value.term,
      timePeriod: detailedCondition.value.timePeriod,
      grade: detailedCondition.value.grade,
      totalEvaluationMin: detailedCondition.value.totalEvaluation.min,
      totalEvaluationMax: detailedCondition.value.totalEvaluation.max,
      creditLevelMin: detailedCondition.value.creditLevel.min,
      creditLevelMax: detailedCondition.value.creditLevel.max,
      interestLevelMin: detailedCondition.value.interestLevel.min,
      interestLevelMax: detailedCondition.value.interestLevel.max,
      skillLevelMin: detailedCondition.value.skillLevel.min,
      skillLevelMax: detailedCondition.value.skillLevel.max,
    },
  });
};

// 講義コードで検索する際に発火する関数
const searchByLectureCode = async () => {
  try {
    const response = await axios.post(
      "/api/hasLectureCode",
      searchClassByLectureCode.value
    );
    console.log("response");
    console.log(response);
    if (response.data.success) {
      nonExistenceMessage.value = "";
      const lectureId = response.data.lectureId;
      router.push({ path: `class/${lectureId}/detail` }, { params: lectureId });
    } else {
      nonExistenceMessage.value = "存在しない講義コードです．";
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
</script>

<template>
  <v-container class="mb-16">
    <v-row justify="center">
      <v-card width="900px">
        <v-tabs
          v-model="tab"
          align-tabs="center"
          bg-color="orange"
          height="60px"
        >
          <v-tab value="one"
            ><v-content class="tab-name">条件で探す</v-content></v-tab
          >
          <v-tab value="two"
            ><v-content class="tab-name">講義コードで探す</v-content></v-tab
          >
        </v-tabs>

        <v-card-text>
          <v-window v-model="tab">
            <v-window-item value="one">
              <v-container class="category-name-and-content-container">
                <p class="category-name">授業名</p>
                <v-text-field
                  placeholder="一攫千金特論"
                  class="input-field"
                  v-model="detailedCondition.lectureName"
                ></v-text-field>
              </v-container>
              <v-container class="category-name-and-content-container">
                <p class="category-name">担当教員名</p>
                <v-text-field
                  placeholder="服部淳生"
                  class="input-field"
                  v-model="detailedCondition.teacherName"
                ></v-text-field>
              </v-container>
              <!-- 他の条件についても同様にコードを追加 -->

              <v-expansion-panels class="mb-4">
                <v-expansion-panel>
                  <v-expansion-panel-title
                    >より詳しい条件で探す</v-expansion-panel-title
                  >
                  <v-expansion-panel-text>
                    <v-container
                      class="detailed-totalEvaluationList-list-container"
                    >
                      <!-- 以下、他の条件の追加 -->
                      <v-container class="category-name-and-content-container">
                        <p class="category-name">開講場所</p>
                        <v-select
                          :items="locationList"
                          v-model="detailedCondition.location"
                          class="pulldown-list"
                        ></v-select>
                      </v-container>

                      <v-container class="category-name-and-content-container">
                        <p class="category-name">開講部局</p>
                        <v-select
                          :items="facultyList"
                          v-model="detailedCondition.faculty"
                          class="pulldown-list"
                        ></v-select>
                      </v-container>

                      <v-container class="category-name-and-content-container">
                        <p class="category-name">開講区分</p>
                        <v-select
                          :items="categoryList"
                          v-model="detailedCondition.category"
                          class="pulldown-list"
                        ></v-select>
                      </v-container>

                      <v-container class="category-name-and-content-container">
                        <p class="category-name">ターム</p>
                        <v-select
                          :items="termList"
                          v-model="detailedCondition.termList"
                          class="pulldown-list"
                        ></v-select>
                      </v-container>

                      <v-container class="category-name-and-content-container">
                        <p class="category-name">曜日</p>
                        <v-select
                          :items="dayOfWeekList"
                          v-model="detailedCondition.dayOfWeek"
                          class="pulldown-list"
                        ></v-select>
                      </v-container>

                      <v-container class="category-name-and-content-container">
                        <p class="category-name">時間</p>
                        <v-select
                          :items="timePeriodList"
                          v-model="detailedCondition.timePeriod"
                          class="pulldown-list"
                        ></v-select>
                      </v-container>

                      <v-container class="category-name-and-content-container">
                        <p class="category-name">履修年次</p>
                        <v-select
                          :items="gradeList"
                          v-model="detailedCondition.grade"
                          class="pulldown-list"
                        ></v-select>
                      </v-container>

                      <v-container class="category-name-and-content-container">
                        <p class="category-name">総合評価</p>
                        <v-select
                          :items="totalEvaluationList"
                          v-model="totalEvaluationString"
                          class="pulldown-list"
                        ></v-select>
                      </v-container>

                      <v-container class="category-name-and-content-container">
                        <p class="category-name">単位取得のしやすさ</p>
                        <v-select
                          :items="totalEvaluationList"
                          v-model="creditLevelString"
                          class="pulldown-list"
                        ></v-select>
                      </v-container>

                      <v-container class="category-name-and-content-container">
                        <p class="category-name">面白さ</p>
                        <v-select
                          :items="totalEvaluationList"
                          v-model="interestLevelString"
                          class="pulldown-list"
                        ></v-select>
                      </v-container>

                      <v-container class="category-name-and-content-container">
                        <p class="category-name">スキルが身につくか</p>
                        <v-select
                          :items="totalEvaluationList"
                          v-model="skillLevelString"
                          class="pulldown-list"
                        ></v-select>
                      </v-container>
                      <!-- 他の条件の追加ここまで -->
                    </v-container>
                  </v-expansion-panel-text>
                </v-expansion-panel>
              </v-expansion-panels>

              <v-btn @click="sendQueryToClassListView" color="orange">
                <v-icon start icon="mdi-checkbox-marked-circle"></v-icon>検索
              </v-btn>
            </v-window-item>

            <v-window-item value="two">
              <v-container class="category-and-content-container">
                <p class="category-name">講義コード</p>
                <v-text-field
                  placeholder="KA*******"
                  v-model="searchClassByLectureCode.lectureCode"
                ></v-text-field>
              </v-container>
              <v-container class="d-flex">
                <v-btn @click="searchByLectureCode" color="orange">
                  <v-icon start icon="mdi-checkbox-marked-circle"></v-icon>検索
                </v-btn>
                <p class="text-red text-center">{{ nonExistenceMessage }}</p>
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
