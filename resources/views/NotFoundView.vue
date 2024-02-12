<script setup>
import { useRouter } from "vue-router";
import pageTitle from "../components/pageTitle.vue";
import BaseUI from "../components/shared/BaseUI.vue";
const router = useRouter();
</script>

<template>
  <BaseUI>
    <template v-slot:header>
      <pageTitle title="ページが存在しません" />
    </template>
    <v-container class="d-flex flex-column">
      <!-- <p class="text-center text-h5">ページが存在しません</p> -->
      <v-btn
        rounded
        max-width="150px"
        class="mx-auto"
        @click="router.push('/welcome')"
        >ホームに戻る</v-btn
      >
    </v-container>
  </BaseUI>
</template>
