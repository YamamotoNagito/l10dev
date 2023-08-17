<script setup>
import { ref } from 'vue'
import vuetify from '../js/vuetify';
import Header from './Header.vue'
import Footer from './Footer.vue'

const message = ref('Hello World!')
</script>

<template>
  <Header></Header>
  <!-- <h1>ねむい</h1> -->
  <Footer></Footer>
</template>
