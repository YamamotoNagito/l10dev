<script setup>
import Welcome from "../components/Welcome.vue";
import SearchClassesView from "../components/SearchClassesView.vue";
import vuetify from "../js/vuetify";
</script>

<template>
  <v-app>
      <v-main>
            <v-row justify="center">
                <Welcome></Welcome>
                <SearchClassesView></SearchClassesView>
            </v-row>
        </v-main>
  </v-app>
</template>