<script setup>
  import { ref } from "vue";
  import { useStore } from "vuex";
  import { useRouter } from "vue-router";
  import axios from "axios";
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
        router.push({ name: "welcome" });
      })
      .catch((err) => {
        console.log(err);
      });
  };

  const items = ref([
    { title: "プロフィール", action: "profile" },
    { title: "ログアウト", action: "logout" }
  ]);
</script>
<template>
  <v-app-bar color="primary" elevation="0" absolute height="80" class="d-flex">
    <v-row align="center">
      <v-col cols="0" sm="0" md="1" lg="1" xl="1"> </v-col>
      <v-col cols="2" sm="2" md="2" lg="2" xl="2">
        <v-toolbar-title
          class="text-white hidden-md-and-down"
          style="cursor: pointer"
          @click="router.push({ name: 'welcome' })"
        >
          かえで
        </v-toolbar-title>
      </v-col>

      <v-col cols="8" sm="8" md="8" lg="8" xl="8" class="d-flex justify-end ml-auto">
        <v-btn variant="text" color="background" @click="router.push({ name: 'welcome' })">
          <v-icon>mdi-magnify</v-icon>
          授業検索
        </v-btn>

        <v-btn
          variant="text"
          color="background"
          v-if="!store.getters.isLoggedIn"
          @click="router.push({ name: 'login' })"
        >
          <v-icon>mdi-login</v-icon>
          ログイン
        </v-btn>

        <v-btn
          variant="text"
          color="background"
          v-if="store.getters.isLoggedIn"
          @click="router.push({ name: 'class/post' })"
        >
          <v-icon>mdi-pencil</v-icon>
          レビュー投稿
        </v-btn>

        <v-btn v-if="store.getters.isLoggedIn" variant="text" color="white">
          <v-icon>mdi-menu</v-icon>
        </v-btn>

        <v-menu v-if="store.getters.isLoggedIn" activator="parent" location="start">
          <v-list>
            <v-list-item v-for="(item, index) in items" :key="index" :value="index" @click="handleMenuItemClick(item)">
              <v-list-item-title :style="item.title === '削除する' ? 'color: red' : ''">{{
                item.title
              }}</v-list-item-title>
            </v-list-item>
          </v-list>
        </v-menu>

        <v-dialog v-model="showDialog" persistent max-width="300px">
          <v-card>
            <v-card-title class="text-h5">確認</v-card-title>
            <v-card-text>このレビューを削除してもよろしいですか？</v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="grey" text @click="showDialog = false">キャンセル</v-btn>
              <v-btn color="red" text @click="deleteReview">削除</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>

        <!-- <v-btn variant="text" color="background" v-if="store.getters.isLoggedIn" @click="clickProfileButton">
          <v-icon>mdi-account</v-icon>
          プロフィール
        </v-btn> -->

        <!-- <v-btn variant="text" color="white" @click="clickLogoutButton">
          <v-icon>mdi-logout</v-icon>
          ログアウト
        </v-btn> -->
      </v-col>
      <v-col cols="0" sm="0" md="1" lg="1" xl="1"></v-col>
    </v-row>
  </v-app-bar>

  <!-- ハンバーガーメニューの中身（サイドバー） -->
  <!-- <v-navigation-drawer v-model="drawer" temporary>
    <v-list nav>
      <v-list-item>
        <v-btn block variant="text" @click="clickProfileButton">
          <v-icon>mdi-account</v-icon>
          プロフィール
        </v-btn>
      </v-list-item>
      <v-list-item>
        <v-btn block variant="text" color="red" @click="clickLogoutButton">
          <v-icon>mdi-logout</v-icon>
          ログアウト
        </v-btn>
      </v-list-item>
    </v-list>
  </v-navigation-drawer> -->
</template>

<style></style>
