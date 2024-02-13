<script setup>
import { ref } from "vue";

import PrivacyPolicy from "../components/PrivacyPolicy.vue";
import axios from "axios";
import pageTitle from "../components/pageTitle.vue";
</script>

<template>
  <pageTitle title="プライバシーポリシー" />
  <!-- <Header></Header> -->
  <PrivacyPolicy></PrivacyPolicy>
  <!-- <Footer></Footer> -->
</template>
