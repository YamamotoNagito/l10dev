<script setup>
import Register from "../components/Register.vue";
import pageTitle from "../components/pageTitle.vue";
import BaseUI from "../components/shared/BaseUI.vue";
</script>

<template>
  <BaseUI>
    <template v-slot:header>
      <pageTitle title="利用登録する" />
    </template>
    <Register />
  </BaseUI>
</template>
