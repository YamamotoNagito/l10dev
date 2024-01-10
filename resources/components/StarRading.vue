<script setup>
import { ref, defineProps } from "vue";
import vuetify from "../js/vuetify";

const props = defineProps(["totalEvaluation"])
</script>

<template>
  <v-rating
    readonly
    :length="5"
    :size="32"
    :model-value="totalEvaluation"
    active-color="blue"
  />
</template>