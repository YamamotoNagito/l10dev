<script setup>
import { ref } from "vue";
import vuetify from "../js/vuetify";
import axios from "axios";
import { useRouter } from "vue-router";

import StarRading from "./StarRading.vue";

const props = defineProps(["classData"]);

const moveToReview = () => {
  console.log("moveToReview");
};
</script>


<template>
  <v-card class="border" max-width="800">
    <v-row justify="space-evenly" align="center">
      <v-col cols="7">
        <v-row>
          <v-col cols="12" sm="8">
            <v-container class="ma-auto pa-1">
              <a
                href="#"
                class="text-decoration-underline text-blue text-h8 text-sm-h6"
              >
                {{ classData.className }}</a
              >
            </v-container>
          </v-col>
          <v-col cols="12" sm="4">
            <v-container class="ma-auto pa-1"
              >{{ classData.teacherName }} 先生</v-container
            >
          </v-col>
        </v-row>
      </v-col>
      <v-col cols="5">
        <v-container class="ma-0 pa-1">
          <v-row align="center" justify="end">
            <v-col cols="12" sm="6" class="d-flex justify-end"><StarRading :totalEvaluation="classData.totalEvaluation"></StarRading></v-col>
            <v-col cols="12" sm="5" class="text-end">({{ classData.numberOfReviews }})</v-col></v-row>
          <v-container
            class="d-flex flex-row align-center justify-end ma-1 pa-1"
            ><v-btn color="blue" @click="moveToReview"
              ><v-icon>mdi-comment-plus-outline</v-icon>
              <p class="text-h9">レビュー</p></v-btn
            ></v-container
          >
        </v-container>
      </v-col>
    </v-row>
  </v-card>
</template>
