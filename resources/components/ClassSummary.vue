<script setup>
import { ref } from "vue";
import vuetify from "../js/vuetify";
import axios from "axios";
import { useRouter } from "vue-router";

const props = defineProps(["classData"])

const moveToReview = () => {
  console.log("moveToReview")
}
</script>


<template>
  <v-card class="border" max-width="800">
        <v-container class="d-flex flex-row align-center justify-space-around">
          <v-container class="ma-2 pa-0">
            <a href="#" class="text-decoration-underline text-blue text-h6">
              {{ classData.className }}</a
            >
          </v-container>
          <v-container class="ma-0 pa-0"
            >{{ classData.teacherName }} 先生</v-container
          >
          <v-container class="ma-0 pa-0">
            <v-container
              class="d-flex flex-row align-center justify-end ma-0 pa-0"
              >
              <!-- ここには星のコンポーネントを別で読み込む予定 -->
              <div>★★★★★</div>
              <div>({{ classData.numberOfReviews }})</div></v-container
            >
            <v-container
              class="d-flex flex-row align-center justify-end ma-0 pa-0"
              ><v-btn color="blue" @click="moveToReview"
                ><v-icon>mdi-comment-plus-outline</v-icon>
                <p>レビューする
                </p></v-btn
              ></v-container
            >
          </v-container>
        </v-container>
      </v-card>
</template>
