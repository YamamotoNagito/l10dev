<script setup>
  import RessetPassword from "../components/RessetPassword.vue";
  import pageTitle from "../components/shared/pageTitle.vue";
  import BaseUI from "../components/shared/BaseUI.vue";
</script>

<template>
  <BaseUI>
    <template #header>
      <pageTitle title="パスワードをリセットする" />
    </template>
    <RessetPassword />
  </BaseUI>
</template>
