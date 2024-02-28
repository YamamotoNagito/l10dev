<script setup>
  import { ref, defineProps } from "vue";

  const props = defineProps(["classInformationData"]);

  //　年度，ターム，曜日，時限をまとめて一つの文字列にする関数
  const integrateLectureDetailTimes = (lectureDetailTimes) => {
    return `${lectureDetailTimes.year}-${lectureDetailTimes.term}-${lectureDetailTimes.dayOfWeek}-${lectureDetailTimes.timePeriod}`;
  };

  // 「基本情報」の表の中で使用するデータをオブジェクトにして返す関数
  // propsのclassInformationDataを親コンポーネントから読み込んで実行される
  const modifyClassInformationData = (classInformationData) => {
    if (classInformationData && classInformationData.classInformationDataList) {
      // 講義コードをまとめて１つの文字列にする
      const lectureCodesString = classInformationData.classInformationDataList.map((obj) => obj.lectureCode).join(", ");
      // 開講場所をまとめて１つの文字列にする
      const locationString = classInformationData.classInformationDataList.map((obj) => obj.location).join(",");
      // シラバスのurlをまとめて1つの配列に挿入
      const syllabusUrlList = classInformationData.classInformationDataList.map((obj) => obj.syllabusUrl);
      // 開講場所をまとめて１つの配列に挿入
      const integratedTimeList = classInformationData.classInformationDataList.map((obj) =>
        obj.lectureDetailTimes.map((obj) => integrateLectureDetailTimes(obj)).join(" , ")
      );

      classInformationData.lectureCode = lectureCodesString;
      classInformationData.location = locationString;

      classInformationData.integratedTimeList = integratedTimeList;
      classInformationData.syllabusUrlList = syllabusUrlList;

      return classInformationData;
    }
  };
  // propsのclassInformationDataを親コンポーネントから読み込んで，基本情報の表で使うデータセットのオブジェクトを作成．
  const modifiedData = modifyClassInformationData(props.classInformationData);

  // 表の行名とその中のコンテンツをまとめる
  // ただし，表の中で改行が必要なものについては個別に定義
  const tableItemList = ref([
    {
      categoryName: "授業名",
      information: modifiedData.lectureName
    },
    {
      categoryName: "教員",
      information: modifiedData.teacherName
    },
    {
      categoryName: "講義コード",
      information: modifiedData.lectureCode
    },
    {
      categoryName: "開講場所",
      information: modifiedData.location
    }
  ]);
</script>

<template>
  <v-container>
    <v-table>
      <tbody>
        <tr v-for="item in tableItemList" :key="item.categoryName">
          <td>
            <p>{{ item.categoryName }}</p>
          </td>
          <td>
            <p>{{ item.information }}</p>
          </td>
        </tr>
        <tr>
          <td><p>開講時期</p></td>
          <td v-for="time in modifiedData.integratedTimeList" :key="time">
            <p>{{ time }}</p>
          </td>
        </tr>
        <tr>
          <td><p>シラバス</p></td>
          <td v-for="syllabusUrl in modifiedData.syllabusUrlList" :key="syllabusUrl">
            <a :href="syllabusUrl" target="_blank" class="text-blue text-underline">url</a><br />
          </td>
        </tr>
      </tbody>
    </v-table>
  </v-container>
</template>

<style scoped>
  td {
    min-width: 120px;
    max-width: 150px;
  }

  /* p{
  max-width: 100%;
  font-size: 10px;
}

a{
  max-width: 100%;
  font-size: 10px;
} */
</style>
