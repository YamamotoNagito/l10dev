<script setup>
import { ref } from "vue";
import axios from "axios";
import { useStore } from "vuex";

import RadarChart from "./RadarChart.vue";
import StarRading from "./StarRating.vue";

const store = useStore();
const props = defineProps(["reviewData"]);

const reviewUserId = ref(props.reviewData.userId);
const requestUserId = ref(store.getters.userInfo.id);
const requestReviewId = ref(props.reviewData.reviewId);

console.log("reviewUserId:", reviewUserId.value);
console.log("requestUserId:", requestUserId.value);

console.log(
  "reviewUserId:",
  reviewUserId.value,
  "Type:",
  typeof reviewUserId.value
);
console.log(
  "requestUserId:",
  requestUserId.value,
  "Type:",
  typeof requestUserId.value
);

console.log(
  "reviewUserId === requestUserId:",
  reviewUserId.value === requestUserId.value
);

console.log;

// const likeOnReviewInButton = ref(props.reviewData.likeOnReview);

const radarChartData = {
  creditLevel: props.reviewData.creditLevel,
  interestLevel: props.reviewData.interestLevel,
  skillLevel: props.reviewData.skillLevel,
};

const items = ref([
  { title: "編集する", action: "edit" },
  { title: "削除する", action: "delete" },
]);

const showDialog = ref(false); // ダイアログの表示状態

// ケバブボタンのクリックイベント
const handleMenuItemClick = async (item) => {
  console.log("Menu item clicked:", item.title);
  try {
    if (item.action === "edit") {
      // .jsにurlを定義していないが編集ページ遷移かつreviewDataを渡す
      // router.push({ name: 'EditPage', params: { reviewId: props.reviewData.id } });
      console.log(response.data);
    } else if (item.action === "delete") {
      showDialog.value = true;
      // console.log(requestReviewId.value);
    }
  } catch (error) {
    console.error("API call failed:", error);
  }
};

// ダイアログの削除ボタンのクリックイベント
const deleteReview = async () => {
  try {
    const response = await axios.delete(
      `/api/deleteReview/${requestReviewId.value}`
    );
    console.log(response.data);
    showDialog.value = false; // ダイアログを閉じる
  } catch (error) {
    console.error("API call failed:", error);
    showDialog.value = false; // エラー発生時もダイアログを閉じる
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
          <!-- 授業名をreviewDataから取得して表示する -->
          <v-col cols="12" lg="3">
            <v-container class="text-h5">{{
              reviewData.lectureName
            }}</v-container>
          </v-col>
          <v-col cols="12" lg="3">
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

        <v-menu
          activator="parent"
          location="start"
          v-if="reviewUserId === requestUserId"
        >
          <v-list>
            <v-list-item
              v-for="(item, index) in items"
              :key="index"
              :value="index"
              @click="handleMenuItemClick(item)"
            >
              <v-list-item-title
                :style="item.title === '削除する' ? 'color: red' : ''"
                >{{ item.title }}</v-list-item-title
              >
            </v-list-item>
          </v-list>
        </v-menu>

        <v-dialog v-model="showDialog" persistent max-width="300px">
          <v-card>
            <v-card-title class="text-h5">確認</v-card-title>
            <v-card-text>このレビューを削除してもよろしいですか？</v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="grey" text @click="showDialog = false"
                >キャンセル</v-btn
              >
              <v-btn color="red" text @click="deleteReview">削除</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
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
