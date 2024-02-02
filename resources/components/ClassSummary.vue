<script setup>
import { ref, onMounted } from "vue";
import vuetify from "../js/vuetify";
import axios from "axios";
import { useRouter } from "vue-router";

import StarRating from "./StarRating.vue";

// LineとTwitterアイコンの読み込み
import lineLogo from "../assets/img/line.png";
import twitterLogo from "../assets/img/twitter.png";

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
  <v-card class="border pa-5" max-width="800">
    <!-- 授業名 -->
    <v-row justify="space-evenly" align="center">
      <v-col cols="12">
        <v-btn
          flat
          class="text-decoration-underline text-blue text-h7 text-sm-h6 cursor-pointer"
          @click="router.push('/class/' + classData.lectureId + '/detail')"
        >
          {{ classData.lectureName }}
        </v-btn>
      </v-col>
    </v-row>
    <!-- 担当教員名 -->
    <v-row justify="space-evenly" align="center">
      <v-col cols="12">
        <p class="ma-auto pl-5 text-h7 text-sm-h7">
          {{ classData.teacherName }} 先生
        </p>
      </v-col>
    </v-row>
    <v-row justify="space-between" align="center">
      <!-- 星の評価と評価数の合計 -->
      <v-col cols="8" sm="3" class="d-flex align-center"
        ><StarRating :totalEvaluation="classData.totalEvaluation"></StarRating
      ><p>({{ classData.numberOfReviews }})</p></v-col>
      <v-col cols="12" sm="9">
        <v-row justify="end">
          <!-- レビューを投稿するボタン -->
          <v-col cols="4" sm="4">
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
                class="text-h8"
              >
                レビュー
              </p>
            </v-btn>
          </v-col>
          <!-- TwitterとLineで共有するボタン -->
          <v-col cols="3" sm="3" class="d-flex justify-end">
            <img
            class="mr-2"
              :src="twitterLogo"
              alt=""
              width="30px"
              height="30px"
              style="cursor: pointer"
              @click="twitterShare"
            />
            <img
              :src="lineLogo"
              alt=""
              width="30px"
              height="30px"
              style="cursor: pointer"
              @click="LineShare"
            />
          </v-col>
        </v-row>
      </v-col>
    </v-row>
  </v-card>
</template>
