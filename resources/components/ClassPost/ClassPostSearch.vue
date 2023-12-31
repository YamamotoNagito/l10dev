<script setup>
import { ref } from 'vue'
import vuetify from '../../js/vuetify';
import axios from 'axios';
import { useRouter } from 'vue-router'

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
    },
  },
};
</script>

<template>
  <v-container class="mb-16">
    <v-row justify="center">
      <v-card width="900px">
        <v-card-text>
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
        </v-card-text>
      </v-card>
    </v-row>
  </v-container>
</template>

<style scoped>
.category-name {
  font-size: 1.3rem;
}
</style>
