<script setup>
  import { ref } from "vue";
  import { useStore } from "vuex";
  import { useRouter } from "vue-router";
  import MenuItem from "./shared/MenuItem.vue";
  // import { mdiAccount, mdiLogout } from '@mdi/js';

  const router = useRouter();
  const store = useStore();

  const btnSize = ref("large");

  const checkLoggedIn = () => {
    return store.getters.isLoggedIn;
  };

  const isMenuVisible = ref(false);
  const menuItems = ref([
    { title: "プロフィール", action: "profile", style: "" },
    { title: "ログアウト", action: "logout", style: "color: red" }
  ]);

  const toggleMenu = () => {
    isMenuVisible.value = !isMenuVisible.value;
  };

  const handleMenuItemClick = async (item) => {
    try {
      if (item.action === "profile") {
        await router.push({ name: "profile" });
      } else if (item.action === "logout") {
        // ログアウト処理を実行
        store.dispatch("logout");
        await router.push({ name: "login" });
      }
    } catch (error) {
      console.error("ナビゲーションエラー:", error);
      // エラー処理をここに記述
    }
    isMenuVisible.value = false;
  };
</script>
<template>
  <v-app-bar color="primary" elevation="0" absolute height="80" class="d-flex">
    <v-row align="center" no-gutters>
      <v-col cols="0" sm="1" md="1" lg="1" xl="1"> </v-col>
      <v-col cols="3" sm="2" md="2" lg="2" xl="2">
        <v-toolbar-title class="text-white pl-3" style="cursor: pointer" @click="router.push({ name: 'welcome' })">
          かえで
        </v-toolbar-title>
      </v-col>
      <v-col cols="1" sm="3" md="3" lg="3" xl="3"></v-col>
      <v-col cols="6" sm="4" md="4" lg="4" xl="4" class="d-flex justify-end ml-auto">
        <v-btn :size="btnSize" variant="text" color="background" @click="router.push({ name: 'welcome' })">
          <v-icon>mdi-magnify</v-icon>
          検索
        </v-btn>
        <v-btn
          v-if="!checkLoggedIn()"
          :size="btnSize"
          variant="text"
          color="background"
          @click="router.push({ name: 'login' })"
        >
          <v-icon>mdi-login</v-icon>
          ログイン
        </v-btn>
        <v-btn
          v-if="checkLoggedIn()"
          :size="btnSize"
          variant="text"
          color="background"
          @click="router.push({ name: 'class/post' })"
        >
          <v-icon>mdi-pencil</v-icon>
          投稿
        </v-btn>
      </v-col>
      <v-col v-if="checkLoggedIn()" cols="2" sm="1" md="1" lg="1" xl="1" class="d-flex justify-start">
        <v-btn v-if="checkLoggedIn()" :size="btnSize" variant="text" color="background" @click="toggleMenu">
          <v-icon>mdi-menu</v-icon>
        </v-btn>
        <menu-item
          v-if="isMenuVisible"
          :menu-items="menuItems"
          :on-menu-item-click="handleMenuItemClick"
          location="bottom"
        ></menu-item>
      </v-col>
      <v-col cols="0" sm="1" md="1" lg="1" xl="1"></v-col>
    </v-row>
  </v-app-bar>
</template>

<style></style>
