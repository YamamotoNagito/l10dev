<script setup>
  import Terms from "../components/Terms.vue";
  import pageTitle from "../components/pageTitle.vue";
  import BaseUI from "../components/shared/BaseUI.vue";
</script>

<template>
  <BaseUI>
    <template #header>
      <pageTitle title="利用規約" />
    </template>
    <Terms></Terms>
  </BaseUI>
</template>
