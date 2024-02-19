<script setup>
  import { defineProps } from "vue";
  import kaedeMainImg from "../assets/img/kaedeKey.png";

  const propData = defineProps({
    title: String
  });
  console.log("loaded.");
</script>

<template>
  <v-container class="py-10 bg-primary" fluid>
    <div id="title-block">
      <img :src="kaedeMainImg" alt="kaedeMainImg" width="50" height="50" />
      <p class="text-h6 text-md-h4 text-lg-h3">{{ propData.title }}</p>
      <img :src="kaedeMainImg" alt="kaedeMainImg" width="50" height="50" />
    </div>
  </v-container>
</template>

<style>
  #title-block {
    display: flex;
    justify-content: center; /*左右中央*/
    align-items: center; /*上下中央*/
  }
</style>
