<script setup>
  import Welcome from "../components/Welcome.vue";
  import SearchClasses from "../components/SearchClasses.vue";
  import vuetify from "../js/vuetify";
  import pageTitle from '../components/pageTitle.vue';
</script>

<template>
  <pageTitle title="ようこそ"/>
  <Welcome></Welcome>
  <SearchClasses></SearchClasses>
</template>
