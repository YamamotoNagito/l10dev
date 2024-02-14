<script setup>
import Profile from "../components/Profile.vue";
import { ref, onBeforeMount } from "vue";
import axios from "axios";
import { useStore } from "vuex";
import pageTitle from "../components/pageTitle.vue";

const store = useStore();

// ユーザーのプロフィール情報
const userProfile = ref(null);
// そのユーザーが投稿したレビューの配列
const reviewDataList = ref(null);

const fetchUserProfile = async () => {
  try {
    const userId = String(store.getters.userInfo.id);
    console.log(userId);
    const response = await axios.get(`/api/profile/${userId}`);
    console.log("API Response:", response.data);
    console.log("API reviewInfo Response:", response.data.reviewInfo);
    userProfile.value = response.data.userData;

    // userに対するレビュ一覧を返す変数
    reviewDataList.value = response.data.reviewInfo;

    console.log(reviewDataList.value);
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
  <pageTitle title="プロフィール" />
  <Profile
    :userProfile="userProfile"
    :reviewDataList="reviewDataList"
  ></Profile>
</template>
