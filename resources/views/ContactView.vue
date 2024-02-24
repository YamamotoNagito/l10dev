<script setup>
  import Contact from "../components/Contact.vue";
  import pageTitle from "../components/shared/pageTitle.vue";
  import BaseUI from "../components/shared/BaseUI.vue";
</script>

<template>
  <BaseUI>
    <template #header>
      <pageTitle title="お問い合わせ" />
    </template>
    <Contact></Contact>
  </BaseUI>
</template>
