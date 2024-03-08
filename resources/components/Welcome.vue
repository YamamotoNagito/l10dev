<script setup>
  import { ref } from "vue";

  const message = ref("Hello World!");
</script>

<template>
  <v-container>
    <!-- 検索機能の紹介 -->
    <v-row>
      <v-col cols="5"></v-col>
      <v-col cols="7"></v-col>
    </v-row>
    <!-- 投稿機能の紹介(どのように反映されるかも) -->
    <v-row>
      <v-col cols="7"></v-col>
      <v-col cols="5"></v-col>
    </v-row>
    <!-- シェア機能の紹介 -->
    <v-row>
      <v-col cols="7">
        <img src="../assets/img/undraw_share.svg">
      </v-col>
      <v-col cols="5">
        <p class="text-h1">気になる授業をシェアしよう</p>
        <!-- <div class="text-h1">気になる授業を</div>
        <div class="text-h1">シェアしよう</div> -->
      </v-col>
    </v-row>
    <!-- 使ってみてね的なメッセージ -->
    <v-row>
      <v-col cols="5">
        <p class="text-h1">あなたのご利用をお待ちしています！</p>
      </v-col>
      <v-col cols="7">
        <img src="../assets/img/undraw_post.svg">
      </v-col>
    </v-row>
    
  </v-container>
</template>
