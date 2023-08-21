<script setup>
import { ref } from 'vue'
import vuetify from '../js/vuetify';
import Header from './Header.vue'
import Footer from './Footer.vue'

const message = ref('Hello World!')
</script>

<template>
  <h1>○○さんようこそ</h1>
  <p>laravel側からユーザー情報を取得すること</p>
  <button>ログアウト</button>
</template>
