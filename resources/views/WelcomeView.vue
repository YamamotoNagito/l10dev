<script setup>
  import Welcome from "../components/Welcome.vue";
  import SearchClasses from "../components/SearchClasses.vue";
  import pageTitle from "../components/pageTitle.vue";
  import BaseUI from "../components/shared/BaseUI.vue";
</script>

<template>
  <BaseUI>
    <template #header>
      <pageTitle title="ようこそ" />
    </template>
    <Welcome></Welcome>
    <SearchClasses></SearchClasses>
  </BaseUI>
</template>
