<script setup>
import { ref } from "vue";
import vuetify from "../js/vuetify";
import axios from "axios";
import { useRouter } from "vue-router";
import ReviewSummary from "./ReviewSummary.vue";

const reviewDataList = ref([
  {
    reviewId: "1",
    name: "碇シンジ",
    totalEvaluation: "5",
    likeOnReview: 100,
    yearOfAttendance: 2024,
    date : "",
    evaluation: "秀",
    attendance: "なし",
    pastQuestion: "なし",
    assignments: "テスト",
    midtermGrades: "レポート",
    finalGrades: "レポート",
    ease : 3,
    interesting : 5,
    qualityOfTeacher : 5,
    support : 2,
    skills : 4,
    comment:
      "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
  },
  {
    reviewId: "2",
    name: "Yuki Takahara",
    totalEvaluation: "5",
    likeOnReview: 10000,
    yearOfAttendance: 2024,
    date : "",
    evaluation: "秀",
    attendance: "なし",
    pastQuestion: "なし",
    assignments: "テスト",
    midtermGrades: "レポート",
    finalGrades: "レポート",
    ease : 5,
    interesting : 5,
    qualityOfTeacher : 5,
    support : 5,
    skills : 5,
    comment: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
  },
  {
    reviewId: "3",
    name: "Karl Marx",
    totalEvaluation: "5",
    likeOnReview: 100,
    yearOfAttendance: 2024,
    date : "2023年12月25日",
    evaluation: "秀",
    attendance: "なし",
    pastQuestion: "なし",
    assignments: "テスト",
    midtermGrades: "レポート",
    finalGrades: "レポート",
    ease : 5,
    interesting : 5,
    qualityOfTeacher : 5,
    support : 5,
    skills : 5,
    comment: "いい授業じゃ。とてもためになるのぉ",
  },
  {
    reviewId: "4",
    name: "Marcus Aurelius Antoninus",
    totalEvaluation: "5",
    likeOnReview: 2000,
    yearOfAttendance: 2024,
    date : "",
    evaluation: "秀",
    attendance: "なし",
    pastQuestion: "なし",
    assignments: "テスト",
    midtermGrades: "レポート",
    finalGrades: "レポート",
    ease : 3,
    interesting : 3,
    qualityOfTeacher : 5,
    support : 1,
    skills : 5,
    comment: "国の経済政策に役立てます",
  },
]);
</script>

<template>
  <v-container class="d-flex flex-column align-center ga-5">
    <v-container v-for="n in reviewDataList.length" :key="n">
      <ReviewSummary class="ma-auto" :reviewData="reviewDataList[n - 1]"></ReviewSummary>
    </v-container>
  </v-container>
</template>