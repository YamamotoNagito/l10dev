<script setup>
  import Login from "../components/Login.vue";
  import pageTitle from "../components/pageTitle.vue";
  import BaseUI from "../components/shared/BaseUI.vue";
</script>

<template>
  <BaseUI>
    <template #header>
      <pageTitle title="ログインする" />
    </template>
    <Login></Login>
  </BaseUI>
</template>
