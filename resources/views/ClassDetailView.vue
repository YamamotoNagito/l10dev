<script setup>
import { ref, getCurrentInstance, onBeforeMount } from "vue";
import ClassDetail from "../components/ClassDetail.vue";
import Loading from "../components/Loading.vue";
import axios from "axios";
// import pageTitle from '../components/pageTitle.vue';

const lectureId = ref(null);
// 後でこのコメントアウトは外す！
const classDetailData = ref(null);
const isLoading = ref(true);
const error = ref(null);

const getclassDetailData = async (lectureId) => {
  const data = {
    lectureId: lectureId.value,
  };

  try {
    const response = await axios.post("/api/searchByLectureId", data);
    // const response = await axios.post("/api/hasLectureCode", data);
    console.log(response.data);

    return response.data;

    // その他の処理
  } catch (error) {
    if (error.response) {
      // サーバーからのエラーレスポンスがある場合
      console.error(error.response.data); // エラーレスポンスをコンソールに出力
    } else {
      // リクエストがサーバーに届かなかった場合など
      console.error(error.message);
    }
    // しっかりとBEでエラーメッセージを返しているならば、messageを代入しても良い
    error.value = "エラーが発生しました。時間をおいて再度お試しください。";
  }
};

onBeforeMount(async () => {
  // contextから$routeを取得する
  const { $route } = getCurrentInstance().appContext.config.globalProperties;
  //lectureIdを$routeから取得
  lectureId.value = $route.params.lectureId;
  console.log(`lecture id  is ${lectureId.value}`);

  classDetailData.value = await getclassDetailData(lectureId);
  // classDetailData.value = getclassDetailData(lectureCode.value);

  isLoading.value = false;

  // console.log(classDetailData2)
  console.log(classDetailData.value);
});
</script>

<template>
  <v-container v-if="isLoading">
    <Loading />
  </v-container>

  <!-- とりあえずエラーメッセージをそのまま表示する -->
  <v-container v-else-if="error">
    <v-alert type="error">{{ error }}</v-alert>
  </v-container>

  <v-container v-else>
    <ClassDetail :classDetailData="classDetailData"></ClassDetail>
  </v-container>
</template>
