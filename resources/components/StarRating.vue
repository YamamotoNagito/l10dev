<script setup>
import { ref, defineProps } from "vue";
import vuetify from "../js/vuetify";

const props = defineProps(["totalEvaluation"])
</script>

<template>
  <v-row class="ml-1">
    <v-col>
      <v-rating
        readonly
        :length="5"
        :size="20"
        :model-value="totalEvaluation"
        active-color="blue"
      ></v-rating>
    </v-col>
    </v-row>
</template>
