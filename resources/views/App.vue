<script setup>
import { ref } from 'vue'
import vuetify from '../js/vuetify';
import Header from '../components/Header.vue'
import Footer from '../components/Footer.vue'

const message = ref('Hello World!')
</script>

<template>
  <Header></Header>
  <!-- <h1>ねむい</h1> -->
  <RouterView />
  <Footer></Footer>
</template>
