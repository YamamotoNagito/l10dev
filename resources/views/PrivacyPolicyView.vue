<script setup>
  import PrivacyPolicy from "../components/PrivacyPolicy.vue";
  import pageTitle from "../components/pageTitle.vue";
</script>

<template>
  <BaseUI>
    <template #header>
      <pageTitle title="プライバシーポリシー" />
    </template>
    <PrivacyPolicy></PrivacyPolicy>
  </BaseUI>
</template>
