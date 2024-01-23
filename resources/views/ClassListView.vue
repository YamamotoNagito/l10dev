<script setup>
import { useRoute, onBeforeRouteUpdate } from "vue-router";
import { ref, onBeforeMount, onBeforeUnmount } from "vue";
import axios from "axios";
import ClassList from "../components/ClassList.vue";

// searchClasses.vueで「検索」ボタンを押すととquery付きのpathでこのファイルのViewがrouter.pushで読み込まれる
// path内のそのqueryをpathから取得し，格納する．
// この情報を検索条件としてバックに投げる．
const detailedCondition = ref(null);

// 授業一覧内のリストに格納する授業情報リスト．バックから受けとった授業情報のリストをこの変数に格納し，classList.vueに送る
const classDataList = ref([]);

const route = useRoute();

const searchClassByDetailedCondition = async () => {
  // path内のqueryから取得した値がdetailedConditionに格納されているはずなので，それが出力されるはず
  console.log("detailed condition is:")
  console.log(detailedCondition.value);
  try {
    const response = await axios.post(
      "/api/searchByConditions",
      detailedCondition.value
    );
    console.log("response");
    console.log(response);
    classDataList.value = response.data.classDataList;
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

  // classDataListにはこのようなリストがバックから送られてくるはず（後で消す）
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

  console.log(classDataList.value);  //バックからとってきた授業情報リストがclassDataListに格納されたはずだが，なぜかundefinedになっている
};

// queryパラメータからデータをフェッチ
const fetchData = async () => {
  detailedCondition.value = route.query;
  // console.log(detailedCondition.value)
};

onBeforeMount(async () => {
  // 別のpathから移動してきたとき，またはページをリロード，初回読み込みの時に発火
  // onBeforeRouteUpdateか，この関数かどちらかが発火する
  await fetchData(); //path内のqueryを取得し，detailedConditionに格納
  if (detailedCondition.value) {
    await searchClassByDetailedCondition(); //detailedConditionをバックに投げて，classDataListに格納
  } else {
    console.log("detailed condition is null");
  }
});

// 同じpathからqueryを変更して移動してきたとき，queryから検索するデータを取得する
// OnBeforeMountか，この関数かどちらかが発火する
onBeforeRouteUpdate(async () => {
  await fetchData();//path内のqueryを取得し，detailedConditionに格納
  if (detailedCondition.value) {
    console.log("Before Route Update: Data exists");
    await searchClassByDetailedCondition();//detailedConditionをバックに投げて，classDataListに格納
  } else {
    console.log("Before Route Update: detailed condition is null");
  }
});

// この関数は開発用！！！後で消す！！v-btnを押したら発火する
//　授業情報のリストをバックからとってきて，正しくclassDataList内に格納されたか確認するための関数
const showClassDataList = () => {
  console.log("Class data list is :");
  console.log(classDataList.value);
};
</script>

<template>
  <ClassList v-if="classDataList" :classDataList="classDataList"></ClassList>
  <!-- このv-btnは開発用！！後で消す -->
  <v-btn class="mx-auto" @click="showClassDataList">sample</v-btn>
</template>

