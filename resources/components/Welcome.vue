<script setup>
  import welcomeRadar from "../assets/img/welcomeInfoRadar.png";
</script>

<template>
  <v-container>
    <!-- 検索機能の紹介(星での検索を解禁したらつくる) -->
    <!-- <v-row>
      <v-col></v-col>
    </v-row> -->
    <!-- 閲覧機能の紹介 -->
    <v-row>
      <v-col>
        <v-row>
          <v-col cols="12" sm="12" md="6" lg="6" xl="6" class="d-flex flex-column justify-center align-center">
            <p class="text-h4 text-md-h3 text-lg-h3 text-center mb-5">評価がグラフでわかる！</p>

            <p class="text-h5 text-md-h4 text-lg-h4 text-center">・単位取得のしやすさ</p>
            <p class="text-h5 text-md-h4 text-lg-h4 text-center">・スキルが身につくか</p>
            <p class="text-h5 text-md-h4 text-lg-h4 text-center">・授業の面白さ</p>
          </v-col>
          <v-col cols="12" sm="12" md="6" lg="6" xl="6">
            <v-img :src="welcomeRadar" />
          </v-col>
        </v-row>
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="5">
        <p class="text-h1">先輩のコメントも参考にしよう</p>
      </v-col>
      <v-col cols="7">
        <img src="../assets/img/detail_reviews2.png" />
      </v-col>
    </v-row>
    <!-- シェア機能の紹介 -->
    <v-row>
      <v-col cols="7">
        <img src="../assets/img/undraw_share.svg" />
      </v-col>
      <v-col cols="5">
        <p class="text-h1">気になる授業をシェアしよう</p>
      </v-col>
    </v-row>
    <!-- 使ってみてね的なメッセージ -->
    <v-row>
      <v-col cols="5">
        <p class="text-h1">あなたのご利用をお待ちしています！</p>
      </v-col>
      <v-col cols="7">
        <img src="../assets/img/undraw_post.svg" />
      </v-col>
    </v-row>
  </v-container>
</template>
