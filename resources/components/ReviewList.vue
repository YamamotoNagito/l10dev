<script setup>
import { ref, defineProps, computed } from "vue";
import vuetify from "../js/vuetify";
import axios from "axios";
import { useRouter } from "vue-router";
import ReviewSummary from "./ReviewSummary.vue";

const props = defineProps(["reviewDataList"]);
const reviewDataList2 = ref(props.reviewDataList)

const itemsPerPage = 10;
const currentPage = ref(1);

const totalPages = computed(() =>
  Math.ceil(reviewDataList2.value.length / itemsPerPage)
);
const displayedItems = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage;
  const end = start + itemsPerPage;
  return reviewDataList2.value.slice(start, end);
});
</script>

<template>
  <v-container class="d-flex flex-column align-center ga-5">
    <!-- <v-container v-for="n in reviewDataList.length" :key="n">
      <ReviewSummary class="ma-auto" :reviewData="reviewDataList[n - 1]"></ReviewSummary>
    </v-container> -->
    <v-container v-for="n in displayedItems.length" :key="n">
      <ReviewSummary
        class="ma-auto"
        :reviewData="displayedItems[n - 1]"
      ></ReviewSummary>
    </v-container>

    <v-pagination
      v-model="currentPage"
      :length="totalPages"
      :totalVisible="5"
    ></v-pagination>
  </v-container>
</template>