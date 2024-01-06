<script setup>
import { ref } from "vue";
import vuetify from "../js/vuetify";
import axios from "axios";
import { useRouter } from "vue-router";
import ReviewListVue from "./ReviewList.vue";
import GraphTabs from './GraphTabs.vue';
import ClassInformationTable from "./ClassInformationTable.vue";
import RadarChart from "./RadarChart.vue";

const classInformationData = ref({
  lectureName: "一攫千金特論",
  teacherName: "服部淳生",
  lectureCode: "KA*******",
  place: "A1-433",
  term: "3ターム",
  day: "火曜日",
  period: "2限",
  syllabus: "https://weather.yahoo.co.jp/weather/jp/34/6710.html",
});

const reviewDataList = ref([
  {
    reviewId: "1",
    name: "碇シンジ",
    totalEvaluation: 3,
    likeOnReview: 100,
    yearOfAttendance: 2024,
    date: "",
    evaluation: "秀",
    attendance: "なし",
    pastQuestion: "なし",
    assignments: "テスト",
    midtermGrades: "レポート",
    finalGrades: "レポート",
    ease: 3,
    interesting: 5,
    qualityOfTeacher: 5,
    support: 2,
    skills: 4,
    comment:
      "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
  },
  {
    reviewId: "2",
    name: "Yuki Takahara",
    totalEvaluation: 4,
    likeOnReview: 10000,
    yearOfAttendance: 2024,
    date: "",
    evaluation: "秀",
    attendance: "なし",
    pastQuestion: "なし",
    assignments: "テスト",
    midtermGrades: "レポート",
    finalGrades: "レポート",
    ease: 5,
    interesting: 5,
    qualityOfTeacher: 5,
    support: 5,
    skills: 5,
    comment:
      "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
  },
  {
    reviewId: "3",
    name: "Karl Marx",
    totalEvaluation: 5,
    likeOnReview: 100,
    yearOfAttendance: 2024,
    date: "2023年12月25日",
    evaluation: "秀",
    attendance: "なし",
    pastQuestion: "なし",
    assignments: "テスト",
    midtermGrades: "レポート",
    finalGrades: "レポート",
    ease: 5,
    interesting: 5,
    qualityOfTeacher: 5,
    support: 5,
    skills: 5,
    comment: "いい授業じゃ。とてもためになるのぉ",
  },
  {
    reviewId: "4",
    name: "Marcus Aurelius Antoninus",
    totalEvaluation: 3,
    likeOnReview: 2000,
    yearOfAttendance: 2024,
    date: "",
    evaluation: "秀",
    attendance: "なし",
    pastQuestion: "なし",
    assignments: "テスト",
    midtermGrades: "レポート",
    finalGrades: "レポート",
    ease: 3,
    interesting: 3,
    qualityOfTeacher: 5,
    support: 1,
    skills: 5,
    comment: "国の経済政策に役立てます",
  },
]);

const radarChartData = ref([3, 4, 5, 3, 4]);
</script>

<template>
  <v-app>
    <v-main>
      <v-container class="ma-auto mb-15">
        <v-container class="d-flex flex-row justify-center align-center">
            <h2 class="text-h3 text-center">{{ classInformationData.lectureName }}</h2>
            <v-btn
              class="d-flex flex-row ml-5"
              color="orange"
              ><v-icon>mdi-comment-plus</v-icon>
              <p>レビューを作成</p>
            </v-btn>
        </v-container>
        <v-expansion-panels class="ma-auto w-75">
          <v-expansion-panel>
            <v-expansion-panel-title> 基本情報 </v-expansion-panel-title>
            <v-expansion-panel-text>
              <ClassInformationTable
                :classInformationData="classInformationData"
              ></ClassInformationTable>
              <RadarChart :radarChartData="radarChartData"></RadarChart>
            </v-expansion-panel-text>
          </v-expansion-panel>
        </v-expansion-panels>
        <GraphTabs></GraphTabs>
        <ReviewListVue :reviewDataList="reviewDataList"></ReviewListVue>
      </v-container>
    </v-main>
  </v-app>
</template>