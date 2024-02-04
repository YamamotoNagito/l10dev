<script setup>
import { ref } from "vue";
import vuetify from "../js/vuetify";
import { useStore } from "vuex";
import { useRouter } from "vue-router";
import axios from "axios";
import kaedeDefalut from "../assets/img/kaedeDefalut.png";
// import { mdiAccount, mdiLogout } from '@mdi/js';

// ドロワーの開閉状態を管理する変数
const drawer = ref(false);

const router = useRouter();
const store = useStore();

const navigateToWelcome = () => {
  router.push({ name: "welcome" });
};

const clickProfileButton = async () => {
  // console.log("クリックされたで");
  // console.log(store.getters.userInfo.id);

  try {
    router.push({ name: "profile" });

    // その他の処理
  } catch (error) {
    if (error.response) {
      // サーバーからのエラーレスポンスがある場合
      console.error(error.response.data); // エラーレスポンスをコンソールに出力
    } else {
      // リクエストがサーバーに届かなかった場合など
      console.error(error.message);
    }
  }
};

const clickLogoutButton = async () => {
  await axios
    .post("/api/logout")
    .then((response) => {
      // ちゃんと送信できたか確認用
      // console.log(response.data.success);
      // if(response.data.success){
      // }
      store.dispatch("logout");
      router.push("/welcome");
    })
    .catch((err) => {
      console.log(err);
    });
};
</script>
<template>
  <v-app-bar color="orange" scroll-behavior="hide" elevation="3">
    <v-app-bar-nav-icon
      v-if="store.getters.isLoggedIn"
      @click.stop="drawer = !drawer"
    />
    <v-btn icon @click="navigateToWelcome">
      <img :src="kaedeDefalut" alt="kaedeDefalut" width="40" height="40" />
    </v-btn>

    <v-toolbar-title
      class="hidden-md-and-down"
      @click="router.push({ name: 'welcome' })"
    >
      かえで ~広大生の学びを支える情報サイト~
    </v-toolbar-title>
    <v-spacer />

    <v-btn
      v-if="!store.getters.isLoggedIn"
      @click="router.push({ name: 'login' })"
    >
      <v-icon>mdi-login</v-icon>
      ログイン
    </v-btn>
    <v-btn @click="router.push({ name: 'welcome' })">
      <v-icon>mdi-magnify</v-icon>
      授業検索
    </v-btn>
    <v-btn
      v-if="store.getters.isLoggedIn"
      @click="router.push({ name: 'class/post' })"
    >
      <v-icon>mdi-pencil</v-icon>
      レビュー投稿
    </v-btn>
  </v-app-bar>

  <!-- ハンバーガーメニューの中身（サイドバー） -->
  <v-navigation-drawer v-model="drawer" temporary>
    <v-list nav>
      <v-list-item>
        <v-btn block variant="text" @click="clickProfileButton">
          <v-icon>mdi-account</v-icon>
          プロフィール
        </v-btn>
      </v-list-item>
      <!-- <v-list-item>
        <v-btn block variant="text" @click="router.push({ name: ''})">
          <v-icon>mdi-cog</v-icon>
            設定
          </v-btn>
        </v-list-item> -->
      <v-list-item>
        <v-btn block variant="text" color="red" @click="clickLogoutButton">
          <v-icon>mdi-logout</v-icon>
          ログアウト
        </v-btn>
      </v-list-item>
    </v-list>
  </v-navigation-drawer>
</template>

<style></style>
