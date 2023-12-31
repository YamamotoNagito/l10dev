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
]);

const attendanceSelected = ref(null);
const attendanceOptions = ref([
  { label: '出席あり', value: 'yes' },
  { label: '出席なし', value: 'no' },
]);

</script>

<template>
  <v-container class="mb-16">
    <v-row justify="center">
      <v-card width="900px">
        <v-card-text>
          <v-container>
            <p class="text-decoration-underline text-lg-h6 ma-3">受講年度</p>
            <!-- 受講年度のセレクトボックス -->
            <v-btn-toggle v-model="attendYearSelected" color="blue">
              <v-btn
                v-for="option in attendYearOptions"
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
          </v-container>

          <v-container>
            <p class="text-decoration-underline">出席の有無</p>
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
          </v-container>

          <!-- 他の項目も同様に追加 -->
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
