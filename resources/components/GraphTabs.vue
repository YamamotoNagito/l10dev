<script setup>
import { ref } from "vue";
import BarGraph from "./BarGraph.vue";

const tab = ref(null);

const graphDataList = ref({
  grade: {
    S: 20,
    A: 30,
    B: 30,
    C: 30,
    D: 80,
  },
  attendance: {
    everyday: 1,
    sometimes: 20,
    none: 200,
  },
  pastTest: {
    yes: 20,
    no: 300,
  },
  assignment: {
    yes: 20,
    no: 300,
  },
  midtermTest: {
    yes: 300,
    no: 1,
  },
  finalTest: {
    yes: 300,
    no: 1,
  },
});
const graphTitleList = ref({
    grade:"成績",
    attendance:"出欠",
    pastTest:"過去問",
    assignment:"日課",
    midtermTest:"中間",
    finalTest:"期末",
})
</script>

<template>
  <v-card class="d-flex flex-column">
    <v-container class="d-flex justify-center">
      <v-tabs v-model="tab">
        <v-tab value="one">成績</v-tab>
        <v-tab value="two">出欠</v-tab>
        <v-tab value="three">過去問</v-tab>
        <v-tab value="four">日課</v-tab>
        <v-tab value="five">中間</v-tab>
        <v-tab value="six">期末</v-tab>
      </v-tabs>
    </v-container>
    <v-card-text>
      <v-container class="d-flex justify-center">
        <v-window v-model="tab">
          <v-window-item value="one">
            <v-container><BarGraph :barGraphData="graphDataList.grade" :chartTitle="graphTitleList.grade"></BarGraph></v-container>
          </v-window-item>
          <v-window-item value="two">
            <v-container><BarGraph :barGraphData="graphDataList.attendance" :chartTitle="graphTitleList.attendance"></BarGraph></v-container>
          </v-window-item>
          <v-window-item value="three">
            <v-container><BarGraph :barGraphData="graphDataList.pastTest" :chartTitle="graphTitleList.pastTest"></BarGraph></v-container>
          </v-window-item>
          <v-window-item value="four">
            <v-container><BarGraph :barGraphData="graphDataList.assignment" :chartTitle="graphTitleList.assignment"></BarGraph></v-container>
          </v-window-item>
          <v-window-item value="five">
            <v-container><BarGraph :barGraphData="graphDataList.midtermTest" :chartTitle="graphTitleList.midtermTest"></BarGraph></v-container>
          </v-window-item>
          <v-window-item value="six">
            <v-container><BarGraph :barGraphData="graphDataList.finalTest" :chartTitle="graphTitleList.finalTest"></BarGraph></v-container>
          </v-window-item>
        </v-window>
      </v-container>
    </v-card-text>
  </v-card>
</template>