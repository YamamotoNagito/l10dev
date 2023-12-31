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
    { label: '2021', value: 'option4' },
    { label: '2020', value: 'option5' },
    { label: '2019', value: 'option6' },
    { label: '2018', value: 'option7' },
    { label: '2017', value: 'option8' },
]);
</script>

<template>
  <v-container class="mb-16">
    <v-row justify="center">
      <v-card width="900px">
        <v-card-text>
          <v-container>
            <p class="text-decoration-underline text-lg-h6 ma-2">受講年度</p>
            <v-radio-group inline v-model="selectedOption" mandatory="false">
              <v-radio
                v-for="option in radioOptions"
                :key="option.value"
                :label="option.label"
                :value="option.value"
                class="mx-2"
                color="blue"
              ></v-radio>
            </v-radio-group>
          </v-container>
        </v-card-text>
      </v-card>
    </v-row>
  </v-container>
</template>

