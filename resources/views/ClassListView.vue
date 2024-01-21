<script setup>
import { useRoute } from "vue-router";
import { ref, onBeforeMount } from "vue";
import axios from "axios";
import ClassList from "../components/ClassList.vue";

// router.pushされる前のSearchClasses.vueから条件で検索する場合の条件をjson形式で送ってもらう
const detailedCondition = ref(null);
// 授業一覧内のリストに格納する授業情報リスト
const classDataList = ref([]);

const route = useRoute();

const searchClassByDetailedCondition = async () => {
  // console.log("detailed condition is:")
  console.log(detailedCondition.value);
  try {
    const response = await axios.post(
      "/api/searchByConditions",
      detailedCondition.value
    );
    console.log("response");
    console.log(response);
    classDatList.value = response.data.classDataList;
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

  // classDataList.value = [
  //   {
  //     className: "一攫千金特論",
  //     classCode: "KA10000",
  //     teacherName: "服部淳生",
  //     totalEvaluation: "5",
  //     numberOfReviews: "70000",
  //   },
  //   {
  //     className: "一攫二千金特論",
  //     classCode: "KA10001",
  //     teacherName: "服部淳生",
  //     totalEvaluation: "5",
  //     numberOfReviews: "70000",
  //   },
  //   {
  //     className: "一攫三千金特論",
  //     classCode: "KA10003",
  //     teacherName: "服部淳生",
  //     totalEvaluation: "5",
  //     numberOfReviews: "70000",
  //   },
  //   {
  //     className: "エヴァンゲリオン特論",
  //     classCode: "KA10004",
  //     teacherName: "田中恒成",
  //     totalEvaluation: "5",
  //     numberOfReviews: "70000",
  //   },
  //   {
  //     className: "おいしいコーヒーの入れ方",
  //     classCode: "KA10005",
  //     teacherName: "田中恒成",
  //     totalEvaluation: "5",
  //     numberOfReviews: "70000",
  //   },
  //   {
  //     className: "君主論",
  //     classCode: "KA10006",
  //     teacherName: "Niccolò Machiavelli",
  //     totalEvaluation: "5",
  //     numberOfReviews: "70000",
  //   },
  //   {
  //     className: "罪と罰",
  //     classCode: "KA10007",
  //     teacherName: "Фёдор Mихáйлович Достоéвский",
  //     totalEvaluation: "5",
  //     numberOfReviews: "70000",
  //   },
  //   {
  //     className: "マルクス経済学",
  //     classCode: "KA10008",
  //     teacherName: "Karl Marx",
  //     totalEvaluation: "5",
  //     numberOfReviews: "70000",
  //   },
  // ];

  console.log(classDataList.value);
};

// queryパラメータからデータをフェッチ
const fetchData = async () => {
  detailedCondition.value = route.query;
  // console.log(detailedCondition.value)
};

// classDataListに授業情報を外部から取得してくる;
// const classDataList2 = ref([
//   {
//     className: "一攫千金特論",
//     classCode: "KA10000",
//     teacherName: "服部淳生",
//     totalEvaluation: "5",
//     numberOfReviews: "70000",
//   },
//   {
//     className: "一攫二千金特論",
//     classCode: "KA10001",
//     teacherName: "服部淳生",
//     totalEvaluation: "5",
//     numberOfReviews: "70000",
//   },
//   {
//     className: "一攫三千金特論",
//     classCode: "KA10003",
//     teacherName: "服部淳生",
//     totalEvaluation: "5",
//     numberOfReviews: "70000",
//   },
//   {
//     className: "エヴァンゲリオン特論",
//     classCode: "KA10004",
//     teacherName: "田中恒成",
//     totalEvaluation: "5",
//     numberOfReviews: "70000",
//   },
//   {
//     className: "おいしいコーヒーの入れ方",
//     classCode: "KA10005",
//     teacherName: "田中恒成",
//     totalEvaluation: "5",
//     numberOfReviews: "70000",
//   },
//   {
//     className: "君主論",
//     classCode: "KA10006",
//     teacherName: "Niccolò Machiavelli",
//     totalEvaluation: "5",
//     numberOfReviews: "70000",
//   },
//   {
//     className: "罪と罰",
//     classCode: "KA10007",
//     teacherName: "Фёдор Mихáйлович Достоéвский",
//     totalEvaluation: "5",
//     numberOfReviews: "70000",
//   },
//   {
//     className: "マルクス経済学",
//     classCode: "KA10008",
//     teacherName: "Karl Marx",
//     totalEvaluation: "5",
//     numberOfReviews: "70000",
//   },
// ]);

// コンポーネントがmountedされたときにデータをフェッチ
onBeforeMount(async () => {
  await fetchData();
  if (detailedCondition.value) {
    await searchClassByDetailedCondition();
  } else {
    console.log("detailed condition is null");
  }
});

</script>

<template>
  <ClassList v-if="classDataList" :classDataList="classDataList"></ClassList>
</template>

