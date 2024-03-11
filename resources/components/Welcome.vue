<script setup>
  import { ref } from "vue";

  const message = ref("Hello World!");
</script>

<template>
  <v-container>
    <!-- 検索機能の紹介(星での検索を解禁したらつくる) -->
    <!-- <v-row>
      <v-col></v-col>
    </v-row> -->
    <!-- 閲覧機能の紹介 -->
    <v-row>
      <v-col cols="5">
        <!-- 画像ガビガビなのでもっといいやつに換えといてくれ -->
        <img src="../assets/img/detail_info_rader.PNG" width="170%" height="170%">
      </v-col>
      <v-col cols="7" class="welcome-wrapper">
        <div>
          <p class="text-h1">
            評価がグラフでわかる！
          </p>
          <p class="text-h2">
            <br>
            ・単位取得のしやすさ<br>
            ・スキルが身につくか<br>
            ・授業の面白さ
          </p>
        </div>
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="5" class="welcome-wrapper">
        <p class="text-h1">先輩のコメントも参考にしよう</p>
      </v-col>
      <v-col cols="7">
        <img src="../assets/img/detail_reviews.PNG">
      </v-col>
    </v-row>
    <!-- シェア機能の紹介 -->
    <v-row>
      <v-col cols="7">
        <img src="../assets/img/undraw_share.svg">
      </v-col>
      <v-col cols="5" class="welcome-wrapper">
        <p class="text-h1">気になる授業をシェアしよう</p>
      </v-col>
    </v-row>
    <!-- 使ってみてね的なメッセージ -->
    <v-row>
      <v-col cols="5" class="welcome-wrapper">
        <p class="text-h1">あなたのご利用をお待ちしています！</p>
      </v-col>
      <v-col cols="7">
        <img src="../assets/img/undraw_post.svg">
      </v-col>
    </v-row>
    
  </v-container>
</template>

<style>
.welcome-wrapper {
  display: flex;
  align-items: center; /*上下中央揃え*/
}
</style>