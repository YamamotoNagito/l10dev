<script setup>
import { ref } from 'vue'
import vuetify from '../js/vuetify';
import { useStore } from 'vuex';

const store = useStore();
const message = ref('Hello World!')
</script>

<template>
  <h1>○○さんようこそ</h1>
  <p>laravel側からユーザー情報を取得すること</p>
  <p v-if="store.getters.isLoggedIn">{{ store.getters.userInfo }}</p>
  <p v-if="store.getters.isLoggedIn">ログイン中</p>
  <p v-else>ログアウト中</p>
  <button>ログアウト</button>
</template>
