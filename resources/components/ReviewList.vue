<script setup>
  import { ref, defineProps, computed, toRefs } from "vue";
  import ReviewSummary from "./ReviewSummary.vue";

  const props = defineProps(["reviewDataList"]);

  const { reviewDataList } = toRefs(props);

  // console.log("review data list is : ");
  // console.log(reviewDataList);

  const itemsPerPage = 10;
  const currentPage = ref(1);

  const totalPages = computed(() => Math.ceil(reviewDataList.value.length / itemsPerPage));
</script>

<template>
  <v-container v-if="reviewDataList" class="d-flex flex-column align-center">
    <v-container v-for="n in reviewDataList.length" :key="n" class="pa-0">
      <ReviewSummary class="ma-auto" :review-data="reviewDataList[n - 1]"></ReviewSummary>
    </v-container>

    <v-pagination v-model="currentPage" :length="totalPages" :total-visible="5"></v-pagination>
  </v-container>
</template>
