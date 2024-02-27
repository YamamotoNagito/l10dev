<template>
  <v-row class="d-flex justify-center">
    <v-col cols="12" sm="10" md="10" lg="8" xl="6">
      <v-card v-if="userProfile" class="my-6" elevation="2">
        <v-card-text>
          <v-row v-for="item in tableData" :key="item.label" class="d-flex justify-center my-1">
            <v-col cols="4" sm="5" md="6" lg="6" xl="6">
              <p class="text-center underline">{{ item.label }}</p>
            </v-col>
            <v-col cols="8" sm="7" md="6" lg="6" xl="6">
              <p class="text-center font-weight-black">{{ item.value }}</p>
            </v-col>
          </v-row>
        </v-card-text>
      </v-card>
      <v-card v-else>
        <v-card-text justify>
          <p>プロフィール情報を取得できませんでした。</p>
        </v-card-text>
      </v-card>
    </v-col>
  </v-row>
  <v-row v-if="reviewDataList.length > 0">
    <v-col cols="12">
      <v-card v-if="reviewDataList" elevation="0">
        <v-tabs v-model="tab" color="deep-purple-accent-4" align-tabs="left">
          <v-tab value="one">投稿数 {{ reviewDataList.length }} 件</v-tab>
        </v-tabs>
        <v-window v-model="tab">
          <v-window-item value="one">
            <ReviewList :review-data-list="reviewDataList"></ReviewList>
          </v-window-item>
        </v-window>
      </v-card>
    </v-col>
  </v-row>
  <v-row v-else>
    <v-col cols="12" class="d-flex justify-center">
      <v-img src="NoPost" alt="NoPost" width="300" height="300"></v-img>
    </v-col>
    <v-col cols="12" class="d-flex justify-center">
      <p>まだ投稿がありません。</p>
    </v-col>
  </v-row>
  <!-- <v-col cols="12" class="d-flex justify-center">
      <v-img src="GoodLuck" alt="GoodLuck" width="300" height="300"></v-img>
    </v-col> -->
</template>

<script setup>
  import ReviewList from "./ReviewList.vue";
  import { ref, defineProps, toRefs, computed } from "vue";
  import NoPost from "../assets/img/no_post_data_at_profile.svg";
  import GoodLuck from "../assets/img/good_luck_high_school_student.svg";

  const props = defineProps({
    userProfile: Object,
    reviewDataList: Array
  });

  const { userProfile, reviewDataList } = toRefs(props);

  const tab = ref(null);

  // 特定のカテゴリーに基づいて表示する情報を制御
  const tableData = computed(() => {
    if (!userProfile.value) return [];

    const basicInfo = [
      { label: "ユーザー名", value: userProfile.value.userName },
      { label: "メールアドレス", value: userProfile.value.userEmail },
      { label: "カテゴリー", value: userProfile.value.category }
    ];

    if (["大学生", "大学院生"].includes(userProfile.value.category)) {
      basicInfo.push(
        { label: "学部", value: userProfile.value.faculty },
        { label: "学科", value: userProfile.value.department },
        { label: "入学年度", value: userProfile.value.admissionYear }
      );
    }
    return basicInfo;
  });
</script>
