<template>
  <v-row justify="center">
    <v-col cols="8">
      <!-- タイトル -->
      <h1 style="font-size: 2rem">プロフィール画面</h1>
      <v-card class="my-8" v-if="userProfile">
        <v-container>
          <v-card-text justify>
            <h1>{{ userProfile.userName }}</h1>
            <p>Email: {{ userProfile.userEmail }}</p>
            <p>Category: {{ userProfile.category }}</p>
            <p>Faculty: {{ userProfile.faculty }}</p>
            <p>Department: {{ userProfile.department }}</p>
            <p>Admission Year: {{ userProfile.admissionYear }}</p>
          </v-card-text>
        </v-container>
      </v-card>
      <v-card v-else>
        <v-container>
          <v-card-text justify>
            <p>プロフィール情報を取得できませんでした。</p>
          </v-card-text>
        </v-container>
      </v-card>
      <!-- レビューリスト -->
      <v-card v-if="reviewDataList">
        <v-tabs v-model="tab" color="deep-purple-accent-4" align-tabs="left">
          <v-tab value="one">投稿した {{ reviewDataList.length }} 件</v-tab>
          <!-- <v-tab value="two">Likes</v-tab> -->
        </v-tabs>

        <v-card-text>
          <v-window v-model="tab">
            <v-window-item value="one">
              <ReviewList :reviewDataList="reviewDataList"></ReviewList>
            </v-window-item>
            <!-- <v-window-item value="two">
              <p>Comming Soon</p>
            </v-window-item> -->
          </v-window>
        </v-card-text>
      </v-card>
    </v-col>
  </v-row>
</template>

<script setup>
import ReviewList from "./ReviewList.vue";
import { ref, defineProps, toRefs } from "vue";

const props = defineProps(["userProfile", "reviewDataList"]);

// 「投稿した」「LIKES」のうちどちらのタブを開くのか
const tab = ref(null);
</script>
