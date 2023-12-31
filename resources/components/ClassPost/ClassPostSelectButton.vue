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

const attendanceSelected = ref(null);
const attendanceOptions = ref([
  { label: '毎回', value: 'yes' },
  { label: 'たまに', value: 'no' },
  { label: 'なし', value: 'no' },
]);

</script>


<template>
  <v-container class="mb-16">
    <v-row justify="center">
      <v-card width="900px">
        <v-card-text>
          <v-container>
            <p class="text-decoration-underline text-lg-h6 ma-2">受講年度</p>
            <!-- 受講年度のセレクトボックス -->
              <v-btn-toggle inline v-model="attendYearSelected" color="blue">
                <v-btn
                  v-for="option in attendYearOptions"
                  :key="option.value"
                  :value="option.value"
                  rounded="xl"
                  width="10%"
                  height="45"
                  style="background-color: LightGray;"
                >
                  {{ option.label }}
                </v-btn>
              </v-btn-toggle>
            <p class="text-decoration-underline text-lg-h6 ma-3">出席の有無</p>
            <!-- 出席の有無のセレクトボックス -->
            <v-btn-toggle v-model="attendanceSelected" color="blue">
              <v-btn
                v-for="option in attendanceOptions"
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
            <p class="text-decoration-underline text-lg-h6 ma-3">単位取得</p>
            <v-rating
              hover
              v-model="rating"
              class="ma-2"
              density="compact"
              :length="5"
              :item-labels="['易しい', '', '', '', '難しい']"
              item-label-position="top"
              active-color="blue"
            />

            <p class="text-decoration-underline text-lg-h6 ma-3">面白さ</p>
            <p class="text-decoration-underline text-lg-h6 ma-3">スキルが身に付く</p>
          </v-container>
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
