<script setup>
  import PrivacyPolicy from "../components/PrivacyPolicy.vue";
  import pageTitle from "../components/shared/pageTitle.vue";
  import BaseUI from "../components/shared/BaseUI.vue";
</script>

<template>
  <BaseUI>
    <template #header>
      <pageTitle title="プライバシーポリシー" />
    </template>
    <PrivacyPolicy></PrivacyPolicy>
  </BaseUI>
</template>
