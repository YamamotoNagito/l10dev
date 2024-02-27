<template>
  <v-row>
    <v-col cols="12">
      <v-card v-if="userProfile" class="my-8">
        <v-card-text justify>
          <v-table>
            <tbody>
              <tr v-for="item in tableData" :key="item.label">
                <td class="label-cell">
                  <p>{{ item.label }}</p>
                </td>
                <td class="value-cell">
                  <p>{{ item.value }}</p>
                </td>
              </tr>
            </tbody>
          </v-table>
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
  import { ref, defineProps, toRefs, computed } from "vue";

  const props = defineProps({
    userProfile: Object,
    reviewDataList: Array
  });

  const { userProfile, reviewDataList } = toRefs(props);

  // 「投稿した」「LIKES」のうちどちらのタブを開くのか
  const tab = ref(null);

  // userProfileからテーブル表示用のデータを生成
  const tableData = computed(() => {
    if (!userProfile.value) return [];
    return [
      { label: "ユーザー名", value: userProfile.value.userName },
      { label: "メールアドレス", value: userProfile.value.userEmail },
      { label: "カテゴリー", value: userProfile.value.category },
      { label: "学部", value: userProfile.value.faculty },
      { label: "学科", value: userProfile.value.department },
      { label: "入学年度", value: userProfile.value.admissionYear }
      // その他の情報を追加可能
    ];
  });
</script>

<style scoped>
  .label-cell {
    min-width: 150px; /* ラベルの最小幅 */
    max-width: 200px; /* ラベルの最大幅 */
  }

  .value-cell {
    min-width: 200px; /* 値の最小幅 */
    max-width: 250px; /* 値の最大幅 */
  }
</style>
