<script setup>
import { ref } from "vue";
import vuetify from "../js/vuetify";
import axios from "axios";
import { useRouter } from "vue-router";

import RadarChart from "./RadarChart.vue";
import StarRading from "./StarRading.vue";

const props = defineProps(["reviewData"]);

const likeOnReviewInButton = ref(props.reviewData.likeOnReview);

const radarChartData = ref([
  props.reviewData.ease,
  props.reviewData.interesting,
  props.reviewData.qualityOfTeacher,
  props.reviewData.support,
  props.reviewData.skills,
]);

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
  <v-card class="border pa-3" max-width="800px">
    <v-row justify="space-around">
      <v-col cols="11">
        <v-row justify="center" align="center">
          <v-col cols="12" lg="6">
            <v-container class="text-h5">{{ reviewData.name }}</v-container>
          </v-col>
          <v-col cols="12" lg="6">
            <StarRading
              :totalEvaluation="reviewData.totalEvaluation"
            ></StarRading>
          </v-col>
        </v-row>
      </v-col>
      <v-col cols="1"> ... </v-col>
    </v-row>
    <v-row>
      <v-col>
        <v-container class="d-flex flex-row align-center pl-1">
          <v-card-subtitle
            >受講年度：{{ reviewData.yearOfAttendance }}年</v-card-subtitle
          >
          <v-card-subtitle>投稿日：{{ reviewData.date }}</v-card-subtitle>
        </v-container>
      </v-col>
    </v-row>
    <v-row>
      <v-col>
        <v-card-text class="ml-1">
          {{ reviewData.comment }}
        </v-card-text>
      </v-col>
    </v-row>

    <v-expansion-panels>
      <v-expansion-panel>
        <v-expansion-panel-title> 詳細情報 </v-expansion-panel-title>
        <v-expansion-panel-text>
          <v-row justify="center">
            <v-col cols="12" sm="12" md="5" lg="5">
              <RadarChart :radarChartData="radarChartData"></RadarChart>
            </v-col>
            <v-col cols="12" sm="12" md="6" lg="6">
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
            </v-col>
          </v-row>
        </v-expansion-panel-text>
      </v-expansion-panel>
    </v-expansion-panels>
  </v-card>
</template>