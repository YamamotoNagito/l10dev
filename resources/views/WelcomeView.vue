<script setup>
import Welcome from "../components/Welcome.vue";
import SearchClassesView from "../components/SearchClassesView.vue";
import vuetify from "../js/vuetify";
</script>

<template>
  <v-app>
      <v-main>
        <v-container>
            <v-row justify="center">
                <SearchClassesView></SearchClassesView>
            </v-row>
        </v-container>
      </v-main>
  </v-app>
</template>
