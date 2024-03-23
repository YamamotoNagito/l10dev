<script setup>
  import welcomeRadar from "../assets/img/welcomeInfoRadar.png";
  import { ref, onMounted } from "vue";
  import axios from "axios";

  const navigateToExternalUrl = () => {
    window.open("https://momiji.hiroshima-u.ac.jp/keiji/460854/460854.html");
  };

  // レビュー総数を保持するリアクティブな変数
  const allReviewCount = ref(0);

  // コンポーネントがマウントされた後にAPIを呼び出す
  onMounted(async () => {
    try {
      const response = await axios.get("/api/allReviewCount");
      allReviewCount.value = response.data; // レビュー総数を更新
      console.log(response.data);
    } catch (error) {
      console.error("API call failed:", error);
    }
  });
</script>

<template>
  <v-container max-width="900px">
    <!-- レビュー投稿のキャンペーン中の案内 -->
    <v-row class="mb-5">
      <v-col class="text-center">
        <p class="text-h5 text-md-h4 text-lg-h4 mb-5">「かえで」リリース記念</p>
        <p class="text-h6 text-md-h5 text-lg-h5 mb-5">レビューを書いてamazonギフトカード受け取ろう！（先着2500件）</p>
        <v-btn variant="text" rounded="xl" class="text-decoration-underline" @click="navigateToExternalUrl">
          詳しくはこちらへ
        </v-btn>
      </v-col>
    </v-row>
    <v-row class="mt-10 mb-16">
      <v-col class="text-center">
        <p class="text-h6 text-md-h5 text-lg-h5 ma-5">現在のレビュー件数</p>
        <p class="text-h3 text-md-h2 text-lg-h2 text-primary">{{ allReviewCount }}</p>
      </v-col>
    </v-row>
    <!-- 検索機能の紹介(星での検索を解禁したらつくる) -->
    <!-- <v-row>
      <v-col></v-col>
    </v-row> -->
    <!-- 閲覧機能の紹介 -->
    <v-row class="mt-10">
      <v-col>
        <v-row>
          <v-col cols="12" sm="12" md="6" lg="6" xl="6" class="d-flex flex-column justify-center align-center">
            <p class="text-h5 text-md-h4 text-lg-h4 text-center">グラフで分かる評価</p>
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
