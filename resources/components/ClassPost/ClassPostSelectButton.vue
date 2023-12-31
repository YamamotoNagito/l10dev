<script setup>
import { ref } from 'vue'
import vuetify from '../../js/vuetify';
import axios from 'axios';
import { useRouter } from 'vue-router'
import Button from '../Button.vue';

const selectedOption = ref('option1');
const radioOptions = ref([
    { label: '2024', value: 'option1' },
    { label: '2023', value: 'option2' },
    { label: '2022', value: 'option3' },
]);
</script>

<template>
  <v-container class="mb-16">
    <v-row justify="center">
      <v-card width="900px">
        <v-card-text>
          <v-container>
            <p>学年</p>
          </v-container>
          <v-btn-toggle v-model="selectedOption" color="blue">
            <v-btn
              v-for="option in radioOptions"
              :key="option.value"
              :value="option.value"
              rounded="xl"
              width="80"
              height="45"
              style="background-color: LightGray;"
            >
              {{ option.label }}
            </v-btn>
          </v-btn-toggle>
        </v-card-text>
      </v-card>
    </v-row>
  </v-container>
</template>

<style>
.v-btn {
  margin: 0 10px;
}
</style>
