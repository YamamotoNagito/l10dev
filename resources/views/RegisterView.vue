<script setup>
  import Register from "../components/RegisterForm.vue";
  import pageTitle from "../components/shared/pageTitle.vue";
  import BaseUI from "../components/shared/BaseUI.vue";
</script>

<template>
  <BaseUI>
    <template #header>
      <pageTitle title="利用登録する" />
    </template>
    <Register />
  </BaseUI>
</template>
