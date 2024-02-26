<template>
  <v-row>
    <v-col cols="12">
      <!-- タイトル -->
      <!-- <h1 style="font-size: 2rem">プロフィール画面</h1> -->
      <v-card v-if="userProfile" class="my-8">
        <v-card-text justify>
          <h1>{{ userProfile.userName }}</h1>
          <p>Email: {{ userProfile.userEmail }}</p>
          <p>Category: {{ userProfile.category }}</p>
          <p>Faculty: {{ userProfile.faculty }}</p>
          <p>Department: {{ userProfile.department }}</p>
          <p>Admission Year: {{ userProfile.admissionYear }}</p>
        </v-card-text>
      </v-card>
      <v-card v-else>
        <v-card-text justify>
          <p>プロフィール情報を取得できませんでした。</p>
        </v-card-text>
      </v-card>
      <!-- レビューリスト -->
      <v-card v-if="reviewDataList" variant="0">
        <v-tabs v-model="tab" color="deep-purple-accent-4" align-tabs="left">
          <v-tab value="one">投稿数 {{ reviewDataList.length }} 件</v-tab>
          <!-- <v-tab value="two">Likes</v-tab> -->
        </v-tabs>

        <v-window v-model="tab">
          <v-window-item value="one">
            <ReviewList :review-data-list="reviewDataList"></ReviewList>
          </v-window-item>
          <!-- <v-window-item value="two">
              <p>Comming Soon</p>
            </v-window-item> -->
        </v-window>
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
