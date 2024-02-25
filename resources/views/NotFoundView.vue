<script setup>
  import { useRouter } from "vue-router";
  import pageTitle from "../components/pageTitle.vue";
  import BaseUI from "../components/shared/BaseUI.vue";
  import NouFoundImage from "../assets/img/not_found.svg";
  const router = useRouter();
</script>

<template>
  <BaseUI>
    <template #header>
      <pageTitle title="ページが存在しません" />
    </template>
    <v-container class="d-flex flex-column align-center justify-center">
      <v-img :src="NouFoundImage" alt="not_found" width="700" class="mb-12" contain />
      <v-btn rounded max-width="150px" class="mx-auto mt-5" @click="router.push({ name: 'welcome' })"
        >ホームに戻る</v-btn
      >
    </v-container>
  </BaseUI>
</template>
