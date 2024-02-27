<template>
  <v-row>
    <v-col cols="12">
      <v-card v-if="userProfile" class="my-8">
        <v-card-text justify>
          <v-table>
            <thead>
              <tr>
                <th class="text-left">項目</th>
                <th class="text-left">情報</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>ユーザー名</td>
                <td>{{ userProfile.userName }}</td>
              </tr>
              <tr>
                <td>メールアドレス</td>
                <td>{{ userProfile.userEmail }}</td>
              </tr>
              <tr>
                <td>カテゴリー</td>
                <td>{{ userProfile.category }}</td>
              </tr>
              <tr>
                <td>学部</td>
                <td>{{ userProfile.faculty }}</td>
              </tr>
              <tr>
                <td>学科</td>
                <td>{{ userProfile.department }}</td>
              </tr>
              <tr>
                <td>入学年度</td>
                <td>{{ userProfile.admissionYear }}</td>
              </tr>
              <!-- その他の情報 -->
            </tbody>
          </v-table>
          <!--
          <v-table>
            <thead>
              <tr>
                <th class="text-left">Name</th>
                <th class="text-left">Calories</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="item in desserts" :key="item.name">
                <td>{{ item.name }}</td>
                <td>{{ item.calories }}</td>
              </tr>
            </tbody>
          </v-table> -->
        </v-card-text>
      </v-card>
      <v-card v-else>
        <v-card-text justify>
          <p>プロフィール情報を取得できませんでした。</p>
        </v-card-text>
      </v-card>
      <!-- レビューリスト -->
      <v-card v-if="reviewDataList">
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
