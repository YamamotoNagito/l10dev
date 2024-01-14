<script setup>
import { ref } from 'vue'
import vuetify from '../js/vuetify';
import Header from '../components/Header.vue'
import Footer from '../components/Footer.vue'

const message = ref('Hello World!')
</script>

<template>
  <v-app>
    <Header></Header>
    <!-- grid system で v-main に対して レイアウトを定義する -->
    <v-main>
      <RouterView />
    </v-main>
    <Footer></Footer>
  </v-app>

</template>
