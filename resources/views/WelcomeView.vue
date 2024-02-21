<script setup>
  import SearchClasses from "../components/SearchClasses.vue";
  import pageTitle from "../components/pageTitle.vue";
  import BaseUI from "../components/shared/BaseUI.vue";
</script>

<template>
  <BaseUI>
    <template #header>
      <pageTitle title="大学生による授業評価をオープンに" />
    </template>
    <SearchClasses></SearchClasses>
  </BaseUI>
</template>
