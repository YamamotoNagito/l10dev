<script setup>
import Welcome from "../components/Welcome.vue";
import SearchClasses from "../components/SearchClasses.vue";
import vuetify from "../js/vuetify";
</script>

<template>
  <v-app>
      <v-main>
            <v-row justify="center">
                <Welcome></Welcome>
                <SearchClasses></SearchClasses>
            </v-row>
        </v-main>
  </v-app>
</template>