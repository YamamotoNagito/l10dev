<script setup>
import { ref, onMounted } from "vue";
import vuetify from "../js/vuetify";
import axios from "axios";
import { useRouter } from "vue-router";

import StarRading from "./StarRating.vue";

const props = defineProps(["classData"]);

const router = useRouter()


// Twitterで共有するための関数
const twitterShare = () => {
  //シェアされるURL
  var url = "http://localhost:9001/class"
  
  // TwitterへのURL
  var shareURL = 'https://twitter.com/intent/tweet?text=' + "%20%23この授業面白そう" + '&url=' + url;  
  location.href = shareURL;
}

// Lineで共有するための関数
const LineShare = () => {
  //シェアされるURL
  var url = "http://localhost:9001/class"
  
  // LineへのURL
  // var shareURL = 'https://twitter.com/intent/tweet?text=' + "%20%23この授業面白そう" + '&url=' + url;  
  var shareURL = "https://social-plugins.line.me/lineit/share?url=" + url;  
  location.href = shareURL;
}


onMounted(() => {
  // Lineボタンのスクリプトを動的に生成し、挿入
  const lineButtonScript = document.createElement("script");
  lineButtonScript.src = "https://www.line-website.com/social-plugins/js/thirdparty/loader.min.js";
  lineButtonScript.async = true;
  lineButtonScript.defer = true;
});

</script>


<template>
  <v-card class="border" max-width="800">
    <v-row justify="space-evenly" align="center">
      <v-col cols="7">
        <v-row>
          <v-col cols="12" sm="8">
            <v-container class="ma-auto pa-1">
              <v-btn flat class="text-decoration-underline text-blue text-h8 text-sm-h6 cursor-pointer" @click="router.push('/class/' + classData.lectureId + '/detail')">
                  {{ classData.lectureName }}
              </v-btn>
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
              <!-- Twitter共有ボタンの配置-->
              <v-container
              class="d-flex flex-row align-center justify-end ma-0 pa-0"
              ><v-btn color="blue" @click="twitterShare"
                ><p>Twitterで共有する
                </p></v-btn
              ></v-container
            >
             <!-- Line共有ボタンの配置-->
            <v-container
              class="d-flex flex-row align-center justify-end ma-0 pa-0"
              ><v-btn color="blue" @click="LineShare"
                ><p>Lineで共有する
                </p></v-btn
              ></v-container
            >
        </v-container>
      </v-col>
    </v-row>
  </v-card>
</template>
