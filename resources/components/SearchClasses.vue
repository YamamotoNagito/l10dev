<script setup>
import { ref } from "vue";
import vuetify from "../js/vuetify";
</script>

<script>
export default {
  data: () => ({
    // ここから検索に関する変数
    // 検索事項のリスト。検索するときはこれをbackendに投げる
    searchContents: {
      // 授業名
      lectureName: null,
      // 担当教員名
      teacherName: null,
      // 開講場所
      place: null,
      // 開講部局
      department: null,
      // 開講区分
      classification: null,
      // 曜日
      day: null,
      // 時限
      time: null,
      // 履修年次
      grade: null,
      // 総合評価
      totalEvaluation: null,
      // 単位取得のしやすさ
      ease: null,
      // 授業の面白さ
      interesting: null,
      // 教員の質
      qualityOfTeacher: null,
      // サポート体制
      support: null,
      // スキルが身につくか
      skill: null,
      // 講義コード
      lectureCode: null,
    },

    // どのタブを表示するか
    tab: null,

    // 検索条件のサンプル。後で消す
    sampleList: [
      "item A",
      "item B",
      "item C",
      "item D",
      "item E",
      "item F",
      "item G",
    ],
    // 開講場所
    placeList: [
      "item A",
      "item B",
      "item C",
      "item D",
      "item E",
      "item F",
      "item G",
    ],
    // 開講部局
    departmentList: [
      "item A",
      "item B",
      "item C",
      "item D",
      "item E",
      "item F",
      "item G",
    ],
    // 開講区分
    classificationList: [
      "item A",
      "item B",
      "item C",
      "item D",
      "item E",
      "item F",
      "item G",
    ],
    // 曜日
    dayList: [
      "月曜日",
      "火曜日",
      "水曜日",
      "木曜日",
      "金曜日",
      "土曜日",
      "日曜日",
    ],
    // 時限
    timeList: [
      "item A",
      "item B",
      "item C",
      "item D",
      "item E",
      "item F",
      "item G",
    ],
    // 履修年次
    gradeList: [
      "学部1年",
      "学部2年",
      "学部3年",
      "学部4年",
      "修士1年",
      "修士2年",
    ],
    // 総合評価・単位取得のしやすさ・面白さ・教員の質・サポート体制・スキルが身につくか
    totalEvaluationList: ["1以下", "2以下", "3以下", "4以下", "5以下"],
  }),
  methods: {
    searchByCondition() {
      console.log(this.searchContents);
      // axios.post("api/")
    },
    searchByLectureCode() {
      console.log(this.searchContents);
    },
  },
};
</script>

<template>
  <!-- <v-tabs align-tabs="center" color="orange">
    <v-tab value="tab-1">One</v-tab>
    <v-tab value="tab-2">Two</v-tab>
  </v-tabs> -->
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
                  v-model="searchContents.lectureName"
                ></v-text-field>
              </v-container>
              <v-container class="category-name-and-content-container">
                <p class="category-name">担当教員名</p>
                <v-text-field
                  placeholder="服部淳生"
                  class="input-field"
                  v-model="searchContents.teacherName"
                ></v-text-field>
              </v-container>

              <v-expansion-panels class="mb-4">
                <v-expansion-panel>
                  <v-expansion-panel-title
                    >より詳しい条件で探す</v-expansion-panel-title
                  >
                  <v-expansion-panel-text>
                    <v-container
                      class="detailed-totalEvaluationList-list-container"
                    >
                      <v-container class="category-name-and-content-container">
                        <p class="category-name">開講場所</p>
                        <v-select
                          :items="placeList"
                          v-model="searchContents.place"
                          class="pulldown-list"
                        ></v-select>
                      </v-container>
                      <v-container class="category-name-and-content-container">
                        <p class="category-name">開講部局</p>
                        <v-select
                          :items="departmentList"
                          v-model="searchContents.department"
                          class="pulldown-list"
                        ></v-select>
                      </v-container>
                      <v-container class="category-name-and-content-container">
                        <p class="category-name">開講区分</p>
                        <v-select
                          :items="classificationList"
                          v-model="searchContents.classification"
                          class="pulldown-list"
                        ></v-select>
                      </v-container>
                      <v-container class="category-name-and-content-container">
                        <p class="category-name">曜日</p>
                        <v-select
                          :items="dayList"
                          v-model="searchContents.day"
                          class="pulldown-list"
                        ></v-select>
                      </v-container>
                      <v-container class="category-name-and-content-container">
                        <p class="category-name">時間</p>
                        <v-select
                          :items="timeList"
                          v-model="searchContents.time"
                          class="pulldown-list"
                        ></v-select>
                      </v-container>
                      <v-container class="category-name-and-content-container">
                        <p class="category-name">履修年次</p>
                        <v-select
                          :items="gradeList"
                          v-model="searchContents.grade"
                          class="pulldown-list"
                        ></v-select>
                      </v-container>
                      <v-container class="category-name-and-content-container">
                        <p class="category-name">総合評価</p>
                        <v-select
                          :items="totalEvaluationList"
                          v-model="searchContents.totalEvaluation"
                          class="pulldown-list"
                        ></v-select>
                      </v-container>
                      <v-container class="category-name-and-content-container">
                        <p class="category-name">単位取得のしやすさ</p>
                        <v-select
                          :items="totalEvaluationList"
                          v-model="searchContents.ease"
                          class="pulldown-list"
                        ></v-select>
                      </v-container>
                      <v-container class="category-name-and-content-container">
                        <p class="category-name">面白さ</p>
                        <v-select
                          :items="totalEvaluationList"
                          v-model="searchContents.interesting"
                          class="pulldown-list"
                        ></v-select>
                      </v-container>
                      <v-container class="category-name-and-content-container">
                        <p class="category-name">教員の質</p>
                        <v-select
                          :items="totalEvaluationList"
                          v-model="searchContents.qualityOfTeacher"
                          class="pulldown-list"
                        ></v-select>
                      </v-container>
                      <v-container class="category-name-and-content-container">
                        <p class="category-name">サポート体制</p>
                        <v-select
                          :items="totalEvaluationList"
                          v-model="searchContents.support"
                          class="pulldown-list"
                        ></v-select>
                      </v-container>
                      <v-container class="category-name-and-content-container">
                        <p class="category-name">スキルが身につくか</p>
                        <v-select
                          :items="totalEvaluationList"
                          v-model="searchContents.skill"
                          class="pulldown-list"
                        ></v-select>
                      </v-container>
                    </v-container>
                  </v-expansion-panel-text>
                </v-expansion-panel>
              </v-expansion-panels>

              <v-btn @click="searchByCondition" color="orange"
                ><v-icon start icon="mdi-checkbox-marked-circle"></v-icon
                >検索</v-btn
              >
            </v-window-item>

            <v-window-item value="two">
              <v-container class="category-and-content-container">
                <p class="category-name">講義コード</p>
                <v-text-field
                  placeholder="KA*******"
                  v-model="searchContents.lectureCode"
                ></v-text-field>
              </v-container>
              <v-btn @click="searchByLectureCode" color="orange"
                ><v-icon start icon="mdi-checkbox-marked-circle"></v-icon
                >検索</v-btn
              >
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