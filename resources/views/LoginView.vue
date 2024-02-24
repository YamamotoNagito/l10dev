<script setup>
  import Login from "../components/Login.vue";
  import pageTitle from "../components/shared/pageTitle.vue";
  import BaseUI from "../components/shared/BaseUI.vue";
</script>

<template>
  <BaseUI>
    <template #header>
      <pageTitle title="ログイン" />
    </template>
    <Login></Login>
  </BaseUI>
</template>
