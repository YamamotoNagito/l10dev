<script setup>
  import { ref, defineProps, computed } from "vue";
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

  const totalPages = computed(() => Math.ceil(props.classDataList.length / itemsPerPage));

  // 1つのpagination内に表示する授業情報のリストを，displayedItemsに格納する
  const displayedItems = computed(() => {
    const start = (currentPage.value - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    return props.classDataList.slice(start, end);
  });
</script>

<template>
  <!-- 検索機能 -->
  <SearchClasses></SearchClasses>

  <!-- ここから検索で出てきた授業のリスト -->
  <v-container class="d-flex flex-column align-center ga-5">
    <v-container v-for="n in displayedItems.length" :key="n">
      <ClassSummary class="mx-auto" :class-data="displayedItems[n - 1]"></ClassSummary>
    </v-container>
  </v-container>

  <v-pagination v-model="currentPage" :length="totalPages" :total-visible="5"></v-pagination>
</template>
