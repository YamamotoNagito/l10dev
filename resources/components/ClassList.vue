<script setup>
import { ref } from "vue";
import vuetify from "../js/vuetify";
import axios from "axios";
import { useRouter } from "vue-router";
import ClassSummary from "./ClassSummary.vue";
import SearchClasses from "./SearchClasses.vue";

// classDataListに授業情報を外部から取得してくる
const classDataList = ref([
  {
    className: "一攫千金特論",
    classCode: "KA10000",
    teacherName: "服部淳生",
    totalEvaluation: "5",
    numberOfReviews: "70000",
  },
  {
    className: "一攫二千金特論",
    classCode: "KA10001",
    teacherName: "服部淳生",
    totalEvaluation: "5",
    numberOfReviews: "70000",
  },
  {
    className: "一攫三千金特論",
    classCode: "KA10003",
    teacherName: "服部淳生",
    totalEvaluation: "5",
    numberOfReviews: "70000",
  },
  {
    className: "エヴァンゲリオン特論",
    classCode: "KA10004",
    teacherName: "田中恒成",
    totalEvaluation: "5",
    numberOfReviews: "70000",
  },
  {
    className: "おいしいコーヒーの入れ方",
    classCode: "KA10005",
    teacherName: "田中恒成",
    totalEvaluation: "5",
    numberOfReviews: "70000",
  },
  {
    className: "君主論",
    classCode: "KA10006",
    teacherName: "Niccolò Machiavelli",
    totalEvaluation: "5",
    numberOfReviews: "70000",
  },
  {
    className: "罪と罰",
    classCode: "KA10007",
    teacherName: "Фёдор Mихáйлович Достоéвский",
    totalEvaluation: "5",
    numberOfReviews: "70000",
  },
  {
    className: "マルクス経済学",
    classCode: "KA10008",
    teacherName: "Karl Marx",
    totalEvaluation: "5",
    numberOfReviews: "70000",
  },
]);
</script>

<template>
  <!-- 検索機能 -->
  <SearchClasses class="mt-6"></SearchClasses>

  <p class="text-center text-h4">授業一覧</p>

  <!-- ここから検索で出てきた授業のリスト -->
  <v-container class="d-flex flex-column align-center ga-5">
    <v-container v-for="n in classDataList.length" :key="n">
      <ClassSummary class="mx-auto" :classData="classDataList[n - 1]"></ClassSummary>
    </v-container>
  </v-container>
</template>