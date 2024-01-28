<script setup>
  import { ref } from 'vue'
  import vuetify from '../js/vuetify';
  import Terms from '../components/Terms.vue'
  import axios from 'axios';
  import pageTitle from '../components/pageTitle.vue';
</script>

<template>
  <!-- <Header></Header> -->
  <pageTitle title="利用規約"/>
  <Terms></Terms>
  <!-- <Footer></Footer> -->
</template>
