<script setup>
import { ref, defineProps, computed } from "vue";
import vuetify from "../js/vuetify";
import axios from "axios";
import { useRouter } from "vue-router";
import ClassSummary from "./ClassSummary.vue";
import SearchClasses from "./SearchClasses.vue";

const props = defineProps(["classDataList"])

const classDataList2 = ref(props.classDataList)
// const displayedItems = ref(props.classDataList)
const itemsPerPage = 5;
const currentPage = ref(1);

const totalPages = computed(() =>
  Math.ceil(classDataList2.value.length / itemsPerPage)
);
const displayedItems = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage;
  const end = start + itemsPerPage;
  return classDataList2.value.slice(start, end);
});
</script>

<template>
  <!-- 検索機能 -->
  <SearchClasses class="mt-6"></SearchClasses>

  <p class="text-center text-h4">授業一覧</p>

  <!-- ここから検索で出てきた授業のリスト -->
  <v-container class="d-flex flex-column align-center ga-5">
    <v-container v-for="n in displayedItems.length" :key="n">
      <ClassSummary class="mx-auto" :classData="displayedItems[n - 1]"></ClassSummary>
    </v-container>
  </v-container>

  <v-pagination
      v-model="currentPage"
      :length="totalPages"
      :totalVisible="5"
    ></v-pagination>
</template>