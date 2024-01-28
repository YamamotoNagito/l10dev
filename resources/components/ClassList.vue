<script setup>
import { ref, defineProps, computed } from "vue";
import vuetify from "../js/vuetify";
import axios from "axios";
import { useRouter } from "vue-router";
import ClassSummary from "./ClassSummary.vue";
import SearchClasses from "./SearchClasses.vue";

// classListView.vueから授業情報のリストを受け取る
const props = defineProps(["classDataList"]);

// paginationで1ページに表示する授業数
const itemsPerPage = 5;

// paginationで現在何ページ目か
const currentPage = ref(1);

const totalPages = computed(() =>
  Math.ceil(props.classDataList.length / itemsPerPage)
);

// 1つのpagination内に表示する授業情報のリストを，displayedItemsに格納する
const displayedItems = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage;
  const end = start + itemsPerPage;
  return props.classDataList.slice(start, end);
});
</script>

<template>
  <!-- 検索機能 -->
  <SearchClasses class="mt-6"></SearchClasses>

  <p class="text-center text-h4">授業一覧</p>

  <!-- ここから検索で出てきた授業のリスト -->
  <v-container class="d-flex flex-column align-center ga-5">
    <v-container v-for="n in displayedItems.length" :key="n">
      <ClassSummary
        class="mx-auto"
        :classData="displayedItems[n - 1]"
      ></ClassSummary>
    </v-container>
  </v-container>

  <v-pagination
    v-model="currentPage"
    :length="totalPages"
    :totalVisible="5"
  ></v-pagination>
</template>
