<script setup>
  import { defineProps } from 'vue';

  const propData = defineProps({
    title:String
  });
  console.log("loaded.");
</script>

<template>
  <p class="text-center text-h6 text-md-h4 text-lg-h3">{{ propData.title }}</p>
</template>