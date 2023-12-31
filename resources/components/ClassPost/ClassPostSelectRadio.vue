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
            <!-- ラジオボタンを行で揃えて表示する -->
            <v-radio-group inline v-model="selectedOption">
              <v-radio
                  v-for="option in radioOptions"
                  :key="option.value"
                  :label="option.label"
                  :value="option.value"
              ></v-radio>
            </v-radio-group>
          </v-card-text>
        </v-card>
      </v-row>
    </v-container>
  </template>

