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
    // information : props.classInformationData.lectureName
    information: props.classInformationData.lectureName,
  },
  {
    categoryName: "教員",
    // information : props.classInformationData.teacherName
    information: props.classInformationData.teacherName,
  },
  {
    categoryName: "講義コード",
    // information : props.classInformationData.teacherName
    information: props.classInformationData.teacherName,
  },
  {
    categoryName: "開講場所",
    // information : props.classInformationData.teacherName
    information: props.classInformationData.teacherName,
  },
  {
    categoryName: "開港時期",
    // information : props.classInformationData.teacherName
    information: props.classInformationData.teacherName,
  },
  {
    categoryName: "シラバス",
    // information : props.classInformationData.teacherName
    information: props.classInformationData.teacherName,
  },
]);

// const headers = [
//   { title: '#', key: 'id' },
//   { title: 'name', key: 'name', align: 'end' },
// ];

// const items = [
//   {id: 1, name: 'An'},
//   {id: 2, name: 'Nam'},
// ];
</script>

<template>
  <v-container>
    <!-- <v-table class="ma-auto">
      <colgroup>
        <col width="30%" />
        <col width="70%" />
      </colgroup>
      <tbody>
        <tr>
          <td>授業名</td>
          <td>{{ classInformationData.lectureName }}</td>
        </tr>
        <tr>
          <td>教員</td>
          <td>{{ classInformationData.teacherName }}</td>
        </tr>
        <tr>
          <td>講義コード</td>
          <td>{{ classInformationData.lectureCode }}</td>
        </tr>
        <tr>
          <td>開講場所</td>
          <td>{{ classInformationData.place }}</td>
        </tr>
        <tr>
          <td>開講時期</td>
          <td>
            {{ classInformationData.term }} - {{ classInformationData.day }} -
            {{ classInformationData.period }}
          </td>
        </tr>
        <tr>
          <td>シラバス</td>
          <td>
            <a :href="classInformationData.syllabus" target="blank">{{
              classInformationData.syllabus
            }}</a>
          </td>
        </tr>
      </tbody>
    </v-table> -->

    <!-- <v-data-table :headers="headers" :items="items"></v-data-table> -->
    <v-data-table
      :headers="headers"
      :items="items"
      hide-default-header
      hide-default-footer
    >
    </v-data-table>
  </v-container>
</template>