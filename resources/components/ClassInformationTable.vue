<script setup>
  import { ref, defineProps } from "vue";
  import { VDataTable } from "vuetify/labs/VDataTable";

  const props = defineProps(["classInformationData"]);

  const integrateLectureDetailTimes = (lectureDetailTimes) => {
    return `${lectureDetailTimes.year}-${lectureDetailTimes.term}-${lectureDetailTimes.dayOfWeek}-${lectureDetailTimes.timePeriod}`;
  };

  const modifyClassInformationData = (classInformationData) => {
    if (classInformationData && classInformationData.classInformationDataList) {
      const lectureCodesString = classInformationData.classInformationDataList.map((obj) => obj.lectureCode).join(", ");
      const locationString = classInformationData.classInformationDataList.map((obj) => obj.location).join(",");
      const syllabusUrlString = classInformationData.classInformationDataList.map((obj) => obj.syllabusUrl).join(",");

      const integratedTimeString = classInformationData.classInformationDataList
        .map((obj) => obj.lectureDetailTimes.map((obj) => integrateLectureDetailTimes(obj)).join(" , "))
        .join("-----");

      classInformationData.lectureCode = lectureCodesString;
      classInformationData.location = locationString;
      classInformationData.syllabusUrl = syllabusUrlString;
      classInformationData.integratedTime = integratedTimeString;

      return classInformationData;
    }
  };

  const modifiedData = modifyClassInformationData(props.classInformationData);

  const headers = ref([
    {
      title: "カテゴリ",
      key: "categoryName"
    },
    {
      title: "授業情報",
      key: "information"
    }
  ]);

  const items = ref([
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
    },
    {
      categoryName: "開講時期",
      information: modifiedData.integratedTime
    },
    {
      categoryName: "シラバス",
      information: modifiedData.syllabusUrl
    }
  ]);
</script>

<template>
  <v-container>
    <v-data-table :headers="headers" :items="items" hide-default-footer> </v-data-table>
  </v-container>
</template>
