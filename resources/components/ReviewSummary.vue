<script setup>
import { ref } from "vue";
import vuetify from "../js/vuetify";
import axios from "axios";
import { useRouter } from "vue-router";

import RadarChart from "./RadarChart.vue";
import StarRading from "./StarRading.vue";

const props = defineProps(["reviewData"]);

const likeOnReviewInButton = ref(props.reviewData.likeOnReview);

const radarChartData = ref([props.reviewData.ease, props.reviewData.interesting, props.reviewData.qualityOfTeacher, props.reviewData.support, props.reviewData.skills])

const isLiked = ref(false);
const isReported = ref(false);

const toggleLiked = () => {
  if (isLiked.value) {
    likeOnReviewInButton.value--;
  } else {
    likeOnReviewInButton.value++;
  }
  isLiked.value = !isLiked.value;
};

const toggleReported = () => {
  isReported.value = !isReported.value;
};
</script>

<template>
  <v-card class="border" max-width="800px">
    <v-container class="d-flex flex-row align-center justify-space-around ma-0">
      <v-container class="d-flex flex-row align-center ma-0 pa-0 ga-5">
        <v-card-title class="text-h5">{{ reviewData.name }}</v-card-title>
        <!-- <p class="text-h6">★★★★★</p> -->
        <StarRading :totalEvaluation="reviewData.totalEvaluation"></StarRading>
      </v-container>
      <v-container class="d-flex flex-row align-center justify-end ma-0 pa-0">
        <v-btn
          class="d-flex flex-row mr-3"
          :color="isLiked ? 'orange' : 'grey'"
          @click="toggleLiked"
          ><v-icon>mdi-thumb-up</v-icon>
          <!-- <p>{{ reviewData.likeOnReview }}</p> -->
          <p>{{ likeOnReviewInButton }}</p>
        </v-btn>
        <v-btn
          :color="isReported ? 'red-accent-4' : 'white'"
          @click="toggleReported"
          >報告する</v-btn
        >
      </v-container>
    </v-container>
    <v-container class="d-flex flex-row align-center ml-2 ga-3">
      <v-card-subtitle
        >受講年度：{{ reviewData.yearOfAttendance }}年</v-card-subtitle
      >
      <v-card-subtitle>投稿日：{{ reviewData.date }}</v-card-subtitle>
    </v-container>
    <v-container class="ml-2">
      <v-card-text>
        {{ reviewData.comment }}
      </v-card-text>
    </v-container>

    <v-expansion-panels>
      <v-expansion-panel>
        <v-expansion-panel-title> 詳細情報 </v-expansion-panel-title>
        <v-expansion-panel-text>
          <v-container class="d-flex flex-row align-center">
            <RadarChart :radarChartData="radarChartData"></RadarChart>
            <v-container>
              <v-table>
                <tbody>
                  <tr>
                    <td>評定</td>
                    <td>{{ reviewData.evaluation }}</td>
                  </tr>
                  <tr>
                    <td>出欠確認</td>
                    <td>{{ reviewData.attendance }}</td>
                  </tr>
                  <tr>
                    <td>過去問の所持</td>
                    <td>{{ reviewData.pastQuestion }}</td>
                  </tr>
                  <tr>
                    <td>日々の課題</td>
                    <td>{{ reviewData.assignments }}</td>
                  </tr>
                  <tr>
                    <td>中間レポ・テスト</td>
                    <td>{{ reviewData.midtermGrades }}</td>
                  </tr>
                  <tr>
                    <td>期末レポ・テスト</td>
                    <td>{{ reviewData.finalGrades }}</td>
                  </tr>
                </tbody>
              </v-table>
            </v-container>
          </v-container>
        </v-expansion-panel-text>
      </v-expansion-panel>
    </v-expansion-panels>
  </v-card>
</template>