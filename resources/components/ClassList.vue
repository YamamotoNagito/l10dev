<script setup>
import { ref, defineProps } from "vue";
import vuetify from "../js/vuetify";
import axios from "axios";
import { useRouter } from "vue-router";
import ClassSummary from "./ClassSummary.vue";
import SearchClasses from "./SearchClasses.vue";

const props = defineProps(["classDataList"])
</script>

<template>
  <!-- 検索機能 -->
  <SearchClasses class="mt-6"></SearchClasses>

  <p class="text-center text-h4">授業一覧</p>

  <!-- ここから検索で出てきた授業のリスト -->
  <v-container class="d-flex flex-column align-center ga-5">
    <v-container v-for="n in classDataList.length" :key="n">
      <ClassSummary class="mx-auto" :classData="classDataList[n - 1]"></ClassSummary>
    </v-container>
  </v-container>
</template>