<template>
  <v-row justify="center">
    <v-col cols="8">
      <!-- タイトル -->
      <h1 style="font-size: 2rem;">プロフィール画面</h1>
      <v-card class="my-8">
        <v-container>
          <v-card-text justify>
            <p>{{ message }}</p>
          </v-card-text>
        </v-container>
      </v-card>
      <!-- レビューリスト -->
      <v-card>
        <v-tabs
          v-model="tab"
          color="deep-purple-accent-4"
          align-tabs="left"
        >
          <v-tab :value="1">投稿した</v-tab>
          <v-tab :value="2">Likes</v-tab>
        </v-tabs>
        <v-window v-model="tab">
          <v-window-item
            v-for="n in 2"
            :key="n"
            :value="n"
          >
          <!-- ここにレビューリストを表示 -->
          </v-window-item>
        </v-window>
      </v-card>
    </v-col>
  </v-row>
</template>

<script setup>
import { ref } from "vue";
import vuetify from "../js/vuetify";
import axios from "axios";
import { useRouter } from "vue-router";
import { useDisplay } from 'vuetify'
import { useStore } from 'vuex';

const store = useStore();
const router = useRouter();
const message = ref('Hello World!')

const tab = ref(null)
</script>
