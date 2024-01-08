<script setup>
import { ref, defineProps } from "vue";
import { VDataTable } from "vuetify/labs/VDataTable";
import vuetify from "../js/vuetify";
import axios from "axios";
import { useRouter } from "vue-router";

const props = defineProps(["classInformationData"]);

const headers = ref([
  {
    title: "カテゴリ",
    key: "categoryName",
  },
  {
    title: "授業情報",
    key: "information",
  },
]);

const items = ref([
  {
    categoryName: "授業名",
    information: props.classInformationData.lectureName,
  },
  {
    categoryName: "教員",
    information: props.classInformationData.teacherName,
  },
  {
    categoryName: "講義コード",
    information: props.classInformationData.teacherName,
  },
  {
    categoryName: "開講場所",
    information: props.classInformationData.place,
  },
  {
    categoryName: "開港時期",
    information: props.classInformationData.term + ",  " + props.classInformationData.day + ",  " + props.classInformationData.period,
  },
  {
    categoryName: "シラバス",
    information: props.classInformationData.syllabus,
  },
]);
</script>

<template>
  <v-container>
    <v-data-table
      :headers="headers"
      :items="items"
      hide-default-footer
    >
    </v-data-table>
  </v-container>
</template>