<script setup>
  import { defineProps } from "vue";

  const props = defineProps(["totalEvaluation"]);
</script>

<template>
  <v-row>
    <v-col>
      <v-rating readonly :length="5" :size="20" :model-value="totalEvaluation" active-color="blue"></v-rating>
    </v-col>
  </v-row>
</template>
