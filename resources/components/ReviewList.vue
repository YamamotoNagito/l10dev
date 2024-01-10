<script setup>
import { ref, defineProps } from "vue";
import vuetify from "../js/vuetify";
import axios from "axios";
import { useRouter } from "vue-router";
import ReviewSummary from "./ReviewSummary.vue";

const props = defineProps(["reviewDataList"])
</script>

<template>
  <v-container class="d-flex flex-column align-center ga-5">
    <v-container v-for="n in reviewDataList.length" :key="n">
      <ReviewSummary class="ma-auto" :reviewData="reviewDataList[n - 1]"></ReviewSummary>
    </v-container>
  </v-container>
</template>