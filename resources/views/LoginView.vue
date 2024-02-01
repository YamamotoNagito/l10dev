<script setup>
import { ref } from 'vue'
import vuetify from '../js/vuetify';
import Login from '../components/Login.vue';
import pageTitle from '../components/pageTitle.vue';
import axios from 'axios';
</script>

<template>
  <!-- <Header></Header> -->
  <pageTitle title="ログインする"/>
  <Login></Login>
  <!-- <Footer></Footer> -->
</template>
