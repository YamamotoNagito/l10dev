<template>
  <v-footer class="bg-third" app absolute>
    <v-row no-gutters>
      <v-col cols="0" sm="0" md="2" lg="2" xl="2"></v-col>
      <v-col cols="6" sm="3" md="2" lg="2" xl="2" class="d-flex justify-center">
        <v-btn variant="text" rounded="xl" @click="navigateToExternalUrl"> かえで製作委員会 </v-btn>
      </v-col>
      <v-col cols="6" sm="3" md="2" lg="2" xl="2" class="d-flex justify-center">
        <v-btn variant="text" rounded="xl" @click="router.push({ name: 'terms' })"> 利用規約 </v-btn>
      </v-col>
      <v-col cols="6" sm="3" md="2" lg="2" xl="2" class="d-flex justify-center">
        <v-btn variant="text" rounded="xl" @click="router.push({ name: 'privacy-policy' })">
          プライバシーポリシー
        </v-btn>
      </v-col>
      <v-col cols="6" sm="3" md="2" lg="2" xl="2" class="d-flex justify-center">
        <v-btn variant="text" rounded="xl" @click="router.push({ name: 'contact' })"> お問い合わせ </v-btn>
      </v-col>
      <v-col cols="0" sm="0" md="2" lg="2" xl="2"></v-col>
    </v-row>
  </v-footer>
</template>

<script setup>
  import { useRouter } from "vue-router";
  import kaedeMainImg from "../assets/img/kaedeKey.png";

  const navigateToExternalUrl = () => {
    window.open("https://www.hiroshima-u.ac.jp/iagcc/news/80635");
  };

  const router = useRouter();
</script>

<style></style>
