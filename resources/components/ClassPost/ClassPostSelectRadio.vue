<script setup>
import { ref } from 'vue'
import vuetify from '../../js/vuetify';
import axios from 'axios';
import { useRouter } from 'vue-router'
import Button from '../Button.vue';

const attendYearSelected = ref('option1');
const attendYearOptions = ref([
    { label: '2024', value: 'option1' },
    { label: '2023', value: 'option2' },
    { label: '2022', value: 'option3' },
    { label: '2021', value: 'option4' },
    { label: '2020', value: 'option5' },
    { label: '2019', value: 'option6' },
    { label: '2018', value: 'option7' },
    { label: '2017', value: 'option8' },
]);
const attendanceSelected = ref('option1');
const attendanceOptions = ref([
  { label: '毎回', value: 'option1' },
  { label: 'たまに', value: 'option2' },
  { label: 'なし', value: 'option3' },
]);
const dailyAssignmentSelected = ref('option1');
const dailyAssignmentOptions = ref([
  { label: 'レポート', value: 'option1' },
  { label: 'テスト', value: 'option2' },
  { label: 'レポート＋テスト', value: 'option3' },
  { label: 'なし', value: 'option4' },
]);

</script>

<template>
  <v-container>
    <p class="text-decoration-underline text-lg-h6 ma-2">受講年度</p>
    <v-radio-group inline v-model="attendYearSelected" mandatory="false">
      <v-radio
        v-for="option in attendYearOptions"
        :key="option.value"
        :label="option.label"
        :value="option.value"
        class="mx-2"
        color="blue"
      ></v-radio>
    </v-radio-group>
    <p class="text-decoration-underline text-lg-h6 ma-2">出席の有無</p>
    <v-radio-group inline v-model="attendanceSelected" mandatory="false">
      <v-radio
        v-for="option in attendanceOptions"
        :key="option.value"
        :label="option.label"
        :value="option.value"
        class="mx-2"
        color="blue"
      ></v-radio>
    </v-radio-group>
    <p class="text-decoration-underline text-lg-h6 ma-2">毎回のレポート・テスト</p>
    <v-radio-group inline v-model="dailyAssignmentSelected" mandatory="false">
      <v-radio
        v-for="option in dailyAssignmentOptions"
        :key="option.value"
        :label="option.label"
        :value="option.value"
        class="mx-2"
        color="blue"
      ></v-radio>
    </v-radio-group>
    <!-- リファクタリング後に残りの項目を追加する -->
  </v-container>
</template>

