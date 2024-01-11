<script setup>
import { ref, onMounted } from "vue";
import vuetify from "../js/vuetify";
import axios from "axios";
import { useRouter } from "vue-router";

const props = defineProps(["classData"])

const moveToReview = () => {
  console.log("moveToReview")
}

// Twitterで共有するための関数
const twitterShare = () => {
  //シェアされるURL
  var url = "http://localhost:9001/class-list"
  
  // TwitterへのURL
  var shareURL = 'https://twitter.com/intent/tweet?text=' + "%20%23この授業面白そう" + '&url=' + url;  
  location.href = shareURL;
}

// Lineで共有するための関数
const LineShare = () => {
  //シェアされるURL
  var url = "http://localhost:9001/class-list"
  
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
        </v-container>
      </v-card>
</template>
