<script setup>
  import { ref } from 'vue'
  import vuetify from '../../js/vuetify';
  import axios from 'axios';
  import { useRouter } from 'vue-router'
  import Button from '../Button.vue';

const attendYear = ref('2024');
const attendYearOptions = ref([
  { label: '2024', value: '2024' },
  { label: '2023', value: '2023' },
  { label: '2022', value: '2022' },
  { label: '2021', value: '2021' },
  { label: '2020', value: '2020' },
  { label: '2019', value: '2019' },
  { label: '2018', value: '2018' },
  { label: '2017', value: '2017' },
]);

const attendanceConfirm = ref('毎回');
const attendanceConfirmOptions = ref([
  { label: '毎回', value: '毎回' },
  { label: 'たまに', value: 'たまに' },
  { label: 'なし', value: 'なし' },
]);

const classInterestingSelected = ref('普通');
const classInterestingOptions = ref([
  { label: '激難', value: '激難' },
  { label: '難', value: '難' },
  { label: '普通', value: '普通' },
  { label: '楽', value: '楽' },
  { label: '超楽', value: '超楽' },
]);
</script>

<template>
  <v-container>
    <v-sheet>
      <v-row justify="center">
        <v-col cols="8">
          <v-row>
            <v-col>
              <p class="text-decoration-underline text-h6">受講年度</p>
            </v-col>
          </v-row>
          <v-btn-toggle v-model="attendYear" color="blue">
            <v-row justify="start" no-gutters>
              <v-col cols="12" sm="6" md="4" lg="2" v-for="option in attendYearOptions" :key="option.value">
                <v-btn
                  :value="option.value"
                  block
                  rounded="xl"
                  variant="outlined"
                >
                  {{ option.label }}
                </v-btn>
              </v-col>
            </v-row>
          </v-btn-toggle>
        </v-col>
      </v-row>
    </v-sheet>
  </v-container>
</template>

<style>
  .v-btn {
    margin: 0 10px;
  }
</style>
