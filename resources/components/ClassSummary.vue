<script setup>
import { ref, onMounted } from "vue";
import vuetify from "../js/vuetify";
import axios from "axios";
import { useRouter } from "vue-router";

import StarRating from "./StarRating.vue";

const props = defineProps(["classData"]);

const router = useRouter();

// Twitterで共有するための関数
const twitterShare = () => {
  //シェアされるURL
  var url = "http://localhost:9001/class";

  // TwitterへのURL
  var shareURL =
    "https://twitter.com/intent/tweet?text=" +
    "%20%23この授業面白そう" +
    "&url=" +
    url;
  location.href = shareURL;
};

// Lineで共有するための関数
const LineShare = () => {
  //シェアされるURL
  var url = "http://localhost:9001/class";

  // LineへのURL
  // var shareURL = 'https://twitter.com/intent/tweet?text=' + "%20%23この授業面白そう" + '&url=' + url;
  var shareURL = "https://social-plugins.line.me/lineit/share?url=" + url;
  location.href = shareURL;
};

onMounted(() => {
  // Lineボタンのスクリプトを動的に生成し、挿入
  const lineButtonScript = document.createElement("script");
  lineButtonScript.src =
    "https://www.line-website.com/social-plugins/js/thirdparty/loader.min.js";
  lineButtonScript.async = true;
  lineButtonScript.defer = true;
});
</script>


<template>
  <v-card class="border" max-width="800">
    <!-- 授業名 -->
    <v-row justify="space-evenly" align="center">
      <v-col cols="12">
        <v-btn
          flat
          class="text-decoration-underline text-blue text-h8 text-sm-h6 cursor-pointer"
          @click="router.push('/class/' + classData.lectureId + '/detail')"
        >
          {{ classData.lectureName }}
        </v-btn>
      </v-col>
    </v-row>
    <!-- 担当教員名 -->
    <v-row justify="space-evenly" align="center">
      <v-col cols="12">
        <p class="ma-auto pl-5">{{ classData.teacherName }} 先生</p>
      </v-col>
    </v-row>
    <v-row justify="start" align="center">
      <!-- 星の評価 -->
      <v-col cols="8" sm="3"
        ><StarRating :totalEvaluation="classData.totalEvaluation"></StarRating
      ></v-col>
      <!-- 評価数の合計 -->
      <v-col cols="3" sm="2">({{ classData.numberOfReviews }})</v-col>
      <!-- レビューを投稿するボタン -->
      <v-col cols="12" sm="3">
        <v-btn color="blue">
          <v-icon>mdi-comment-plus-outline</v-icon>
          <p
            @click="
              router.push({
                name: 'class/post',
                query: {
                  lectureName: classData.lectureName,
                  teacherName: classData.teacherName,
                },
              })
            "
            class="text-h9"
          >
            レビュー投稿
          </p>
        </v-btn>
      </v-col>
      <!-- Twitterで共有するボタン -->
      <v-col cols="6" sm="3">
        <v-btn color="blue" @click="twitterShare"
          ><p>Twitterで共有</p></v-btn
        >
      </v-col>
      <!-- LINEで共有するボタン -->
      <v-col cols="6" sm="3">
        <v-btn color="blue" @click="LineShare"><p>Lineで共有</p></v-btn>
      </v-col>
    </v-row>
  </v-card>
</template>
