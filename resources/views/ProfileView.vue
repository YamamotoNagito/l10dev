<script setup>
  import Profile from "../components/Profile.vue";
  import { ref, onBeforeMount } from "vue";
  import axios from "axios";
  import { useStore } from "vuex";
  import pageTitle from "../components/shared/pageTitle.vue";
  import BaseUI from "../components/shared/BaseUI.vue";

  // ユーザーのプロフィール情報
  const userProfile = ref(null);
  // そのユーザーが投稿したレビューの配列
  const reviewDataList = ref(null);

  const fetchUserProfile = async () => {
    try {
      // console.log(userId);
      const response = await axios.get("/api/profile");

      // console.log("API Response:", response.data);
      // console.log("API reviewInfo Response:", response.data.reviewInfo);
      userProfile.value = response.data.userData;

      // userに対するレビュ一覧を返す変数
      reviewDataList.value = response.data.reviewInfo;

      // console.log(reviewDataList.value);
      // console.log(reviewInfo.value);
    } catch (error) {
      console.error(error);
    }
  };

  onBeforeMount(() => {
    fetchUserProfile();
  });
</script>

<template>
  <BaseUI>
    <template #header>
      <pageTitle title="プロフィール" />
    </template>
    <Profile :user-profile="userProfile" :review-data-list="reviewDataList"></Profile>
  </BaseUI>
</template>
