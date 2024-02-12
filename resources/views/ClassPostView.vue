<script setup>
import ClassPost from "../components/ClassPost.vue";
import pageTitle from "../components/pageTitle.vue";
import BaseUI from "../components/shared/BaseUI.vue";
</script>

<template>
  <BaseUI>
    <template v-slot:header>
      <pageTitle title="レビューを投稿する" />
    </template>
    <ClassPost></ClassPost>
  </BaseUI>
</template>
