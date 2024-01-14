<template>
  <ClassList :classDataList="classDataList"></ClassList>
</template>

<script setup>
import { useRoute } from "vue-router";
import { ref, onMounted } from "vue";
import axios from "axios";
import ClassList from "../components/ClassList.vue";

// router.pushされる前のSearchClasses.vueから条件で検索する場合の条件をjson形式で送ってもらう
const detailedCondition = ref({});

const route = useRoute();

const searchClassByDetailedCondition = async () => {
  try {
    const response = await axios.post(
      "/api/hasLectureCode",
      detailedCondition.value
    );
    console.log("response");
    console.log(response);
    // classDatList = response.data.classDataList
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

// queryパラメータからデータをフェッチ
const fetchData = async () => {
  detailedCondition.value = route.query;
};

// コンポーネントがmountedされたときにデータをフェッチ
onMounted(() => {
  fetchData();
  searchClassByDetailedCondition();
});

// classDataListに授業情報を外部から取得してくる
// Lecture_idの追加が必要
const classDataList = ref([
  {
    className: "一攫千金特論",
    classCode: "KA10000",
    teacherName: "服部淳生",
    totalEvaluation: "5",
    numberOfReviews: "70000",
  },
  {
    className: "一攫二千金特論",
    classCode: "KA10001",
    teacherName: "服部淳生",
    totalEvaluation: "5",
    numberOfReviews: "70000",
  },
  {
    className: "一攫三千金特論",
    classCode: "KA10003",
    teacherName: "服部淳生",
    totalEvaluation: "5",
    numberOfReviews: "70000",
  },
  {
    className: "エヴァンゲリオン特論",
    classCode: "KA10004",
    teacherName: "田中恒成",
    totalEvaluation: "5",
    numberOfReviews: "70000",
  },
  {
    className: "おいしいコーヒーの入れ方",
    classCode: "KA10005",
    teacherName: "田中恒成",
    totalEvaluation: "5",
    numberOfReviews: "70000",
  },
  {
    className: "君主論",
    classCode: "KA10006",
    teacherName: "Niccolò Machiavelli",
    totalEvaluation: "5",
    numberOfReviews: "70000",
  },
  {
    className: "罪と罰",
    classCode: "KA10007",
    teacherName: "Фёдор Mихáйлович Достоéвский",
    totalEvaluation: "5",
    numberOfReviews: "70000",
  },
  {
    className: "マルクス経済学",
    classCode: "KA10008",
    teacherName: "Karl Marx",
    totalEvaluation: "5",
    numberOfReviews: "70000",
  },
]);
</script>
