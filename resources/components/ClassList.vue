<script setup>
  import { ref, defineProps, computed } from "vue";
  import ClassSummary from "./ClassSummary.vue";
  import SearchClasses from "./SearchClasses.vue";
  import NoDataImage from "../assets/img/no_data.svg";

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

  <!-- <p class="text-center text-h4">授業一覧</p> -->
  <!-- 授業件数が0件の時の表示 -->
  <v-container v-if="props.classDataList.length === 0" class="d-flex flex-column align-center">
    <p class="text-center text-h5">授業が見つかりませんでした。</p>
    <p class="text-center text-h5">検索条件を変えて再度お試しください。</p>
    <v-img :src="NoDataImage" alt="not_found" width="200" class="my-6" contain />
  </v-container>

  <!-- ここから検索で出てきた授業のリスト -->
  <v-container v-if="props.classDataList.length !== 0" class="d-flex flex-column align-center ga-5">
    <v-container v-for="n in displayedItems.length" :key="n">
      <ClassSummary class="mx-auto" :class-data="displayedItems[n - 1]"></ClassSummary>
    </v-container>
  </v-container>

  <v-pagination v-model="currentPage" :length="totalPages" :total-visible="5"></v-pagination>
</template>
