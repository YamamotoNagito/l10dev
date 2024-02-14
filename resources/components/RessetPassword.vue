<script setup>
import { ref } from "vue";

const email = ref("");

// パスワード再設定に関するapiを呼び出してくる
// 書き方は,Login.vueを参照すること
const clickButton = async () => {
  console.log("クリックされたで");
};
</script>

<template>
  <v-container>
    <p>ここに記述をしていく</p>
    <p>
      メールアドレスを入力してボタンを押すと、メールなどを届かせて、アクセスできるようにしたい
    </p>
    <v-form action="" method="post">
      <v-text-field
        v-model="email"
        label="メールアドレス"
        name="email"
        type="email"
      ></v-text-field>
      <v-btn @click="clickButton">送信</v-btn>
    </v-form>
  </v-container>
</template>
