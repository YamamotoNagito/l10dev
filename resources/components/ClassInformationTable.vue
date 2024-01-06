<script setup>
import { ref, defineProps } from "vue";
import vuetify from "../js/vuetify";
import axios from "axios";
import { useRouter } from "vue-router";

const props = defineProps(["classInformationData"])
</script>

<template>
  <v-container>
    <v-table class="ma-auto">
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
          <td>{{ classInformationData.term }} - {{ classInformationData.day }} - {{ classInformationData.period }}</td>
        </tr>
        <tr>
          <td>シラバス</td>
          <td><a :href="classInformationData.syllabus" target="blank">{{ classInformationData.syllabus }}</a></td>
        </tr>
      </tbody>
    </v-table>
  </v-container>
</template>