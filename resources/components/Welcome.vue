<script setup>
  import welcomeRadar from "../assets/img/welcomeInfoRadar.png";
  import { onMounted } from "vue";
  import axios from "axios";

  // レビュー総数の取得(response.data：レビュー総数)
  onMounted(async () => {
    const response = await axios.get("/api/allReviewCount");
    console.log(response.data);
  });
</script>

<template>
  <v-container max-width="900px">
    <!-- 検索機能の紹介(星での検索を解禁したらつくる) -->
    <!-- <v-row>
      <v-col></v-col>
    </v-row> -->
    <!-- 閲覧機能の紹介 -->
    <v-row class="mb-5">
      <v-col>
        <v-row>
          <v-col cols="12" sm="12" md="6" lg="6" xl="6" class="d-flex flex-column justify-center align-center">
            <p class="text-h5 text-md-h4 text-lg-h4 text-center mb-5">グラフで分かる評価</p>
          </v-col>
          <v-col cols="12" sm="12" md="6" lg="6" xl="6" class="d-flex flex-column justify-center align-center">
            <v-img :src="welcomeRadar" width="500px" height="500px" />
          </v-col>
        </v-row>
      </v-col>
    </v-row>
    <v-row class="image-and-description mb-5">
      <v-col cols="12" sm="12" md="6" lg="6" xl="6" class="d-flex flex-column justify-center align-center">
        <p class="text-h5 text-md-h4 text-lg-h4 text-center mb-5">先輩のコメントも参考に</p>
      </v-col>
      <v-col cols="12" sm="12" md="6" lg="6" xl="6" class="d-flex flex-column justify-center align-center">
        <img src="../assets/img/detail_reviews2.png" width="500px" height="500px" />
      </v-col>
    </v-row>
    <!-- シェア機能の紹介 -->
    <v-row class="mb-5">
      <v-col cols="12" sm="12" md="6" lg="6" xl="6" class="d-flex flex-column justify-center align-center">
        <p class="text-h5 text-md-h4 text-lg-h4 text-center mb-5">気になる授業をシェア</p>
      </v-col>
      <v-col cols="12" sm="12" md="6" lg="6" xl="6" class="d-flex flex-column justify-center align-center">
        <img src="../assets/img/undraw_share.svg" width="400px" height="400px" />
      </v-col>
    </v-row>
    <!-- 使ってみてね的なメッセージ -->
    <v-row class="image-and-description mb-5">
      <v-col cols="12" sm="12" md="7" lg="7" xl="7" class="d-flex flex-column justify-center align-center">
        <p class="text-h5 text-md-h4 text-lg-h4 text-center mb-5">あなたの投稿を待っています</p>
      </v-col>
      <v-col cols="12" sm="12" md="5" lg="5" xl="5" class="d-flex flex-column justify-center align-center">
        <img src="../assets/img/undraw_post.svg" width="400px" height="400px" />
      </v-col>
    </v-row>
  </v-container>
</template>

<style scoped>
  .image-and-description {
    display: flex;
    flex-direction: row-reverse;
  }
</style>
