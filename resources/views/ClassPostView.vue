<script setup>
  import ClassPost from "../components/ClassPost.vue";
  import pageTitle from "../components/shared/pageTitle.vue";
  import BaseUI from "../components/shared/BaseUI.vue";
</script>

<template>
  <BaseUI>
    <template #header>
      <pageTitle title="レビューを投稿する" />
    </template>
    <ClassPost></ClassPost>
  </BaseUI>
</template>
