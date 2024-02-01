<script setup>
import { ref, onMounted, getCurrentInstance, onBeforeMount } from "vue";
import ClassDetail from "../components/ClassDetail.vue";
import { mdiConsoleNetworkOutline } from "@mdi/js";
import axios from "axios";
// import pageTitle from '../components/pageTitle.vue';

const lectureId = ref(null);
// 後でこのコメントアウトは外す！
const classDetailData = ref(null);

const getclassDetailData = async(lectureId) => {

  const data = {
    lectureId:lectureId.value
  }

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
  }
};

onBeforeMount(async() => {
  // contextから$routeを取得する
  const { $route } = getCurrentInstance().appContext.config.globalProperties;
  //lectureIdを$routeから取得
  lectureId.value = $route.params.lectureId;
  console.log(`lecture id  is ${lectureId.value}`);

  classDetailData.value = await getclassDetailData(lectureId);
  // classDetailData.value = getclassDetailData(lectureCode.value);

  // console.log(classDetailData2)
  console.log(classDetailData.value);
});
</script>

<template>
  <!-- <pageTitle title = "授業詳細"/> -->
  <!-- {{ classDetailData }} -->
  <ClassDetail :classDetailData="classDetailData"></ClassDetail>
</template>