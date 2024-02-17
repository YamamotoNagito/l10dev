<script setup>
  import Login from "../components/Login.vue";
  import pageTitle from "../components/pageTitle.vue";
</script>

<template>
  <BaseUI>
    <template v-slot:header>
      <pageTitle title="ログインする" />
    </template>
    <Login></Login>
  </BaseUI>
</template>
