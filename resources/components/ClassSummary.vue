<script setup>
import { onMounted } from "vue";
import { useRouter } from "vue-router";

import StarRating from "./StarRating.vue";

// LineとTwitterアイコンの読み込み
import lineLogo from "../assets/img/line.png";
import xLogo from "../assets/img/xlogo.png";

const props = defineProps(["classData"]);

const router = useRouter();

// Twitterで共有するための関数
const twitterShare = () => {
  //シェアされるURL
  var url = "http://localhost:9001/class";

  // TwitterへのURL
  var shareURL = "https://twitter.com/intent/tweet?text=" + "%20%23この授業面白そう" + "&url=" + url;
  window.open(shareURL, '_blank');
};

// Lineで共有するための関数
const lineShare = () => {
  //シェアされるURL
  var url = "http://localhost:9001/class";

  // LineへのURL
  // var shareURL = 'https://twitter.com/intent/tweet?text=' + "%20%23この授業面白そう" + '&url=' + url;
  var shareURL = "https://social-plugins.line.me/lineit/share?url=" + url;
  window.open(shareURL, '_blank');
};

onMounted(() => {
  // Lineボタンのスクリプトを動的に生成し、挿入
  const lineButtonScript = document.createElement("script");
  lineButtonScript.src = "https://www.line-website.com/social-plugins/js/thirdparty/loader.min.js";
  lineButtonScript.async = true;
  lineButtonScript.defer = true;
});
</script>

<template>
  <v-card variant="outlined" max-width="600" class="pa-3">
    <!-- 授業名 -->
    <v-row>
      <v-col cols="12" class="pb-0">
        <p
          flat
          class="text-decoration-underline text-blue text-h7 text-sm-h6"
          @click="router.push('/class/' + classData.lectureId + '/detail')"
        >
          {{ classData.lectureName }}
        </p>
      </v-col>
    </v-row>
    <!-- 担当教員名 -->
    <v-row>
      <v-col cols="12" class="py-0">
        <p class="text-h7 text-sm-h7 text-grey-darken-3">{{ classData.teacherName }} 先生</p>
      </v-col>
    </v-row>
    <v-row align="center" justify="space-between">
      <!-- 星の評価と評価数の合計 -->
      <!-- 授業あれば「星評価(投稿人数)」を表示するがない際には投稿されていませんを出力 -->
      <v-col v-if="classData.numberOfReviews > 0" cols="8" sm="4" md="" lg="" class="d-flex justify-start align-center my-0 py-0"
        ><v-row>
          <v-col cols="12" sm="" md="" lg="" class="d-flex"
            ><StarRating :total-evaluation="classData.totalEvaluation"></StarRating>
            <p class="mt-1">({{ classData.numberOfReviews }})</p></v-col
          >
        </v-row>
      </v-col>
      <v-col v-else cols="8" sm="4" md="" lg="" class="d-flex justify-start align-center my-0 py-0"
        ><v-row>
          <v-col cols="12" sm="" md="" lg="" class="d-flex">
            <p class="mt-1">投稿がありません</p>
          </v-col>
        </v-row>
      </v-col>
      
      <v-col cols="12" sm="8" md="" lg="" class="d-flex justify-start justify-sm-end">
        <v-btn color="orange-darken-1" class="mr-2 mt-1">
          <v-icon>mdi-pencil</v-icon>
          <p
            class="text-h8"
            @click="
              router.push({
                name: 'class/post',
                query: {
                  lectureName: classData.lectureName,
                  teacherName: classData.teacherName
                }
              })
            "
          >
            レビュー
          </p>
        </v-btn>
        <img
          :src="lineLogo"
          class="mx-1"
          alt=""
          width="40px"
          height="30px"
          style="cursor: pointer"
          @click="lineShare"
        />
        <img
          :src="xLogo"
          class="mx-1"
          alt=""
          width="40px"
          height="30px"
          style="cursor: pointer"
          @click="twitterShare"
        />
      </v-col>
    </v-row>
  </v-card>
</template>

<style scoped>
  .text-decoration-underline{
    cursor: pointer;
  }
</style>
