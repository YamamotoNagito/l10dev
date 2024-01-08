<template>
  <v-row justify="center">
    <v-col cols="8">
      <!-- 受講年度 -->
      <v-row>
        <v-col>
          <p class="text-h6">受講年度</p>
        </v-col>
      </v-row>
      <v-btn-toggle v-model="attendYear" variant="outlined" class="full-height">
        <v-row no-gutters class="my-2">
          <v-col
            v-for="option in attendYearOptions"
            :key="option.value"
          >
            <v-btn
              :value="option.value"
              :size="btnSize"
              rounded="xl"
              class="ml-0"
              color="indigo"
            >
              {{ option.label }}
            </v-btn>
          </v-col>
        </v-row>
      </v-btn-toggle>
      <!-- 出席の有無 -->
      <v-row class="mt-5">
        <v-col>
          <p class="text-h6">出席の有無</p>
        </v-col>
      </v-row>
      <v-btn-toggle v-model="attendanceConfirm" variant="outlined" class="full-height">
        <v-row no-gutters  class="my-2">
          <v-col
            cols="4"
            sm=""
            md=""
            lg=""
            v-for="option in attendanceConfirmOptions"
            :key="option.value"
          >
            <v-btn
              :value="option.value"
              rounded="xl"
              class="ml-0"
              color="indigo"
            >
              {{ option.label }}
            </v-btn>
          </v-col>
        </v-row>
      </v-btn-toggle>
      <!-- 毎回のレポート・テスト -->
      <v-row class="mt-5">
        <v-col>
          <p class="text-h6">毎回のレポート・テスト</p>
        </v-col>
      </v-row>
      <v-btn-toggle v-model="weeklyAssignments" variant="outlined" class="full-height">
        <v-row no-gutters class="my-2">
          <v-col
            cols=""
            sm=""
            md=""
            lg=""
            v-for="option in weeklyAssignmentsOptions"
            :key="option.value"
          >
            <v-btn
              :value="option.value"
              rounded="xl"
              class="ml-0"
              color="indigo"
            >
              {{ option.label }}
            </v-btn>
          </v-col>
        </v-row>
      </v-btn-toggle>
    </v-col>
  </v-row>
</template>

<script setup>
import { ref } from "vue";
import vuetify from "../../js/vuetify";
import axios from "axios";
import { useRouter } from "vue-router";
import Button from "../Button.vue";
import { computed } from 'vue'
import { useDisplay } from 'vuetify'

const attendYear = ref("2024");
const attendYearOptions = ref([
  { label: "2024", value: "2024" },
  { label: "2023", value: "2023" },
  { label: "2022", value: "2022" },
  { label: "2021", value: "2021" },
  { label: "2020", value: "2020" },
  { label: "2019", value: "2019" },
  { label: "2018", value: "2018" },
  { label: "2017", value: "2017" },
]);

const attendanceConfirm = ref("なし");
const attendanceConfirmOptions = ref([
  { label: "なし", value: "なし" },
  { label: "毎回", value: "毎回" },
  { label: "たまに", value: "たまに" },
]);

const weeklyAssignments = ref("なし");
const weeklyAssignmentsOptions = ref([
  { label: "なし", value: "なし" },
  { label: "レポートのみ", value: "レポート" },
  { label: "テストのみ", value: "テスト" },
  { label: "レポート&テスト", value: "レポテス" },
]);

const midtermAssignments = ref("なし");
const midtermAssignmentsOptions = ref([
  { label: "なし", value: "なし" },
  { label: "レポートのみ", value: "レポート" },
  { label: "テストのみ", value: "テスト" },
  { label: "レポート&テスト", value: "レポテス" },
]);

const finalAssignments = ref("なし");
const finalAssignmentsOptions = ref([
  { label: "なし", value: "なし" },
  { label: "レポートのみ", value: "レポート" },
  { label: "テストのみ", value: "テスト" },
  { label: "レポート&テスト", value: "レポテス" },
]);

// valueは文字列として受け渡しをするので、+を用いたくない
const pastExamPossession = ref("過去問題レポート");
const pastExamPossessionOptions = ref([
  { label: "過去問＋過去レポート", value: "レポ問" },
  { label: "過去問のみ", value: "過去問" },
  { label: "過去レポートのみ", value: "過去レポート" },
  { label: "なし", value: "なし" },
]);

// 平均値など取るため文字列ではなく数値でもいいかも
const creditLevelSelected = ref("3");
const creditLevel = ref([
  { label: "激難", value: "1" },
  { label: "難", value: "2" },
  { label: "普通", value: "3" },
  { label: "楽", value: "4" },
  { label: "超楽", value: "5" },
]);

const insterestLevelSelected = ref("3");
const insterestLevel = ref([
  { label: "最悪", value: "1" },
  { label: "悪い", value: "2" },
  { label: "普通", value: "3" },
  { label: "良い", value: "4" },
  { label: "最良", value: "5" },
]);

// ラベル後回し
const skillLevelSelected = ref("3");
const skillLevel = ref([
  { label: "", value: "1" },
  { label: "", value: "2" },
  { label: "", value: "3" },
  { label: "", value: "4" },
  { label: "", value: "5" },
]);

// 画面サイズに合わせてボタンのサイズを返す
const { name } = useDisplay()
const btnSize = computed(() => {
  switch (name.value) {
    case 'xs': return 'x-small';
    case 'sm': return 'x-small';
    case 'md': return 'small';
    case 'lg': return 'small';
    case 'xl': return 'default';
    case 'xxl': return 'default';
  }
  return 'default';
})

</script>

<style>
  .v-btn {
    margin: 0 10px;
  }
  .full-height {
    height: auto !important;
  }
</style>

