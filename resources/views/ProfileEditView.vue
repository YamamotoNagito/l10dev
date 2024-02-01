<script setup>
  import { ref } from 'vue'
  import vuetify from '../js/vuetify';
  import ProfileEdit from '../components/ProfileEdit.vue'
  import axios from 'axios';
  import pageTitle from '../components/pageTitle.vue';
</script>

<template>
  <pageTitle title="プロフィールを編集する"/>
  <!-- <Header></Header> -->
  <ProfileEdit></ProfileEdit>
  <!-- <Footer></Footer> -->
</template>
