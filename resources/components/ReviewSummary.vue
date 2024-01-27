<script setup>
import { ref } from "vue";
import vuetify from "../js/vuetify";
import axios from "axios";
import { useRouter } from "vue-router";
import { useStore } from 'vuex';

import RadarChart from "./RadarChart.vue";
import StarRading from "./StarRating.vue";

const store = useStore();
const props = defineProps(["reviewData"]);

const reviewUserId = ref(props.reviewData.userId);
const requestUserId = ref(store.getters.userInfo.id);

console.log("reviewUserId:", reviewUserId.value);
console.log("requestUserId:", requestUserId.value);

console.log("reviewUserId:", reviewUserId.value, "Type:", typeof reviewUserId.value);
console.log("requestUserId:", requestUserId.value, "Type:", typeof requestUserId.value);

console.log("reviewUserId === requestUserId:", reviewUserId.value === requestUserId.value);

// const likeOnReviewInButton = ref(props.reviewData.likeOnReview);

const radarChartData = {
  creditLevel : props.reviewData.creditLevel,
  interestLevel : props.reviewData.interestLevel,
  skillLevel : props.reviewData.skillLevel,
};

const items = ref([
  { title: '編集する' },
  { title: '削除する' },
]);

// ここを変更
const handleMenuItemClick = async (item) => {
  console.log("Menu item clicked:", item.title);
  try {
    if (item.action === 'edit') {
      // 編集のAPIを呼び出す
      const response = await axios.post('/api/edit-review', { /* パラメータ */ });
      console.log(response.data);
    } else if (item.action === 'delete') {
      // 削除のAPIを呼び出す
      const response = await axios.delete('/api/delete-review', { /* パラメータ */ });
      console.log(response.data);
    }
  } catch (error) {
    console.error("API call failed:", error);
  }
};

// const isLiked = ref(false);
// const isReported = ref(false);

// const toggleLiked = () => {
//   if (isLiked.value) {
//     likeOnReviewInButton.value--;
//   } else {
//     likeOnReviewInButton.value++;
//   }
//   isLiked.value = !isLiked.value;
// };

// const toggleReported = () => {
//   isReported.value = !isReported.value;
// };
</script>

<template>
  <v-card class="border pa-3" max-width="800px">
    <v-row justify="space-around">
      <v-col cols="11">
        <v-row justify="center" align="center">
          <v-col cols="12" lg="6">
            <v-container class="text-h5">{{ reviewData.userName }}</v-container>
          </v-col>
          <v-col cols="12" lg="6">
            <StarRading
              :totalEvaluation="reviewData.totalEvaluation"
            ></StarRading>
          </v-col>
        </v-row>
      </v-col>
      <v-col cols="1">
        <v-btn
          v-if="reviewUserId === requestUserId"
          icon="mdi-dots-horizontal"
          variant="text"
        >
        </v-btn>

        <v-menu activator="parent" location="start" v-if="reviewUserId === requestUserId">
          <v-list>
            <v-list-item
              v-for="(item, index) in items"
              :key="index"
              :value="index"
              @click="handleMenuItemClick(item)"
            >
              <v-list-item-title>{{ item.title }}</v-list-item-title>
            </v-list-item>
          </v-list>
        </v-menu>
      </v-col>
    </v-row>
    <v-row>
      <v-col>
        <v-container class="d-flex flex-row align-center pl-1">
          <v-card-subtitle
            >受講年度：{{ reviewData.attendanceYear }}年</v-card-subtitle
          >
          <v-card-subtitle>投稿日：{{ reviewData.createdAt }}</v-card-subtitle>
        </v-container>
      </v-col>
    </v-row>
    <v-row>
      <v-col>
        <v-card-text class="ml-1">
          {{ reviewData.comments }}
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
                      <td>{{ reviewData.grades }}</td>
                    </tr>
                    <tr>
                      <td>出欠確認</td>
                      <td>{{ reviewData.attendanceConfirm }}</td>
                    </tr>
                    <tr>
                      <td>過去問の所持</td>
                      <td>{{ reviewData.pastExamPossession }}</td>
                    </tr>
                    <tr>
                      <td>日々の課題</td>
                      <td>{{ reviewData.weeklyAssignments }}</td>
                    </tr>
                    <tr>
                      <td>中間レポ・テスト</td>
                      <td>{{ reviewData.midtermAssignments }}</td>
                    </tr>
                    <tr>
                      <td>期末レポ・テスト</td>
                      <td>{{ reviewData.finalAssignments }}</td>
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
