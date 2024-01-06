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

const classInterestingSelected = ref('option3');
const classInterestingOptions = ref([
  { label: '激難', value: 'option1' },
  { label: '難', value: 'option2' },
  { label: '普通', value: 'option3' },
  { label: '楽', value: 'option4' },
  { label: '超楽', value: 'option5' },
]);

</script>


<template>
    <v-sheet>
        <v-row justify="center">
            <v-col cols="8">
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

                    variant="outlined"
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
                    variant="outlined"
                >
                    {{ option.label }}
                </v-btn>
                </v-btn-toggle>
                <p class="text-decoration-underline text-lg-h6 ma-3">面白さ</p>
                <v-btn-toggle v-model="classInterestingSelected">
                <v-btn
                    v-for="option in classInterestingOptions"
                    :key="option.value"
                    :value="option.value"
                    rounded="xl"
                    width="80"
                    height="45"
                    variant="outlined"
                >
                    {{ option.label }}
                </v-btn>
                </v-btn-toggle>
            </v-col>
        </v-row>
    </v-sheet>
</template>


<style>
.v-btn {
  margin: 0 10px;
}
</style>
