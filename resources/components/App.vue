<script setup>
import { ref } from 'vue'

const message = ref('Hello World!')
</script>

<template>
  <h1>{{ message }}</h1>
  <v-btn block text class="text-transform py-4 my-2" color="primary">ボタン</v-btn>

  <!-- <v-app>
    <v-main>
      <v-container><span class="font-weight-bold"> 変わるよ </span></v-container>
    </v-main>
  </v-app> -->
  
</template>
