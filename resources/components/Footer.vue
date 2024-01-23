<template>
    <!-- <v-app> -->
      <v-footer class="bg-grey-lighten-1" app absolute>
        <v-row no-gutters>
          <v-col cols="0" sm="0" md="2" lg="2" xl="2"></v-col>
          <v-col cols="6" sm="3" md="2" lg="2" xl="2" class="d-flex justify-center" >
            <v-btn
              @click="navigateToExternalUrl"
              variant="text"
              rounded="xl">
              Developed by かえで製作委員会
            </v-btn>
          </v-col>
          <v-col cols="6" sm="3" md="2" lg="2" xl="2" class="d-flex justify-center" >
            <v-btn
              @click="router.push({ name: 'terms'})"
              variant="text"
              rounded="xl" >
              利用規約
            </v-btn>
          </v-col>
          <v-col cols="6" sm="3" md="2" lg="2" xl="2" class="d-flex justify-center" >
            <v-btn
              @click="router.push({ name: 'privacy-policy'})"
              variant="text"
              rounded="xl" >
              プライバシーポリシー
            </v-btn>
          </v-col>
          <v-col cols="6" sm="3" md="2" lg="2" xl="2" class="d-flex justify-center" >
            <v-btn
              @click="router.push({ name: 'contact'})"
              variant="text"
              rounded="xl" >
              お問い合わせ
            </v-btn>
          </v-col>
          <v-col cols="0" sm="0" md="2" lg="2" xl="2"></v-col>
            <v-col class="text-center mt-4" cols="12">
              {{ new Date().getFullYear() }} — かえで
            </v-col>
        </v-row>
      </v-footer>
    <!-- </v-app> -->
</template>

<script setup>
import vuetify from '../js/vuetify';
import { useRouter } from 'vue-router';

const navigateToExternalUrl = () => {
  window.location.href = "https://www.hiroshima-u.ac.jp/iagcc/news/80635";
};

const router = useRouter();
</script>

<style>
</style>
