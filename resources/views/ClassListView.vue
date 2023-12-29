<script setup>
import ClassList from "../components/ClassList.vue";
</script>

<template>
  <v-app>
    <v-main>
      <v-container class="mx-auto mb-15">
        <v-container class="mx-auto"><p class="text-h4 text-center">授業検索結果</p></v-container>
        <ClassList></ClassList>
      </v-container>
    </v-main>
  </v-app>
</template>