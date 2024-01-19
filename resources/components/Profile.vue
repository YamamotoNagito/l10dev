<template>
  <v-row justify="center">
    <v-col cols="8">
      <!-- タイトル -->
      <h1 style="font-size: 2rem;">プロフィール画面</h1>
      <v-card class="my-8" v-if="userProfile">
        <v-container>
          <v-card-text justify>
            <p>{{ message }}</p>
            <h1>{{ userProfile.userName }}</h1>
            <p>Email: {{ userProfile.userEmail }}</p>
            <p>Category: {{ userProfile.category }}</p>
            <p>Faculty: {{ userProfile.faculty }}</p>
            <p>Department: {{ userProfile.department }}</p>
            <p>Admission Year: {{ userProfile.admissionYear }}</p>
          </v-card-text>
        </v-container>
      </v-card>
      <v-card v-else>
        <v-container>
          <v-card-text justify>
            <p>プロフィール情報を取得できませんでした。</p>
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
import { ref, onMounted } from 'vue';
import vuetify from "../js/vuetify";
import axios from "axios";
import { useRouter } from "vue-router";
import { useDisplay } from 'vuetify'
import { useStore } from 'vuex';

const store = useStore();
const router = useRouter();
const message = ref('Hello World!')


const userProfile = ref(null);

// const user = store.getters.userInfo;
// console.log(user);

const fetchUserProfile = async () => {
  try {
    const userId = String(store.getters.userInfo.id);
    console.log(userId);
    const response = await axios.get(`/api/profile/${userId}`);
    console.log('API Response:', response.data);
    userProfile.value = response.data;
  } catch (error) {
    console.error(error);
  }
}

onMounted(() => {
  fetchUserProfile();
});


const tab = ref(null)
</script>
