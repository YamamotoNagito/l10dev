<script setup>
import { ref, defineProps } from "vue";
import BarGraph from "./BarGraph.vue";

const tab = ref(null);

const props = defineProps(["classBarGraphData"])

const graphTitleList = ref({
    grades:"成績",
    attendanceConfirm:"出欠",
    pastExamPossesion:"過去問",
    weeklyAssignments:"日課",
    midtermAssignments:"中間",
    finalAssignments:"期末",
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
            <v-container><BarGraph :barGraphData="classBarGraphData.grades" :chartTitle="graphTitleList.grades"></BarGraph></v-container>
          </v-window-item>
          <v-window-item value="two">
            <v-container><BarGraph :barGraphData="classBarGraphData.attendanceConfirm" :chartTitle="graphTitleList.attendanceConfirm"></BarGraph></v-container>
          </v-window-item>
          <v-window-item value="three">
            <v-container><BarGraph :barGraphData="classBarGraphData.pastExamPossesion" :chartTitle="graphTitleList.pastExamPossesion"></BarGraph></v-container>
          </v-window-item>
          <v-window-item value="four">
            <v-container><BarGraph :barGraphData="classBarGraphData.weeklyAssignments" :chartTitle="graphTitleList.weeklyAssignments"></BarGraph></v-container>
          </v-window-item>
          <v-window-item value="five">
            <v-container><BarGraph :barGraphData="classBarGraphData.midtermAssignments" :chartTitle="graphTitleList.midtermAssignments"></BarGraph></v-container>
          </v-window-item>
          <v-window-item value="six">
            <v-container><BarGraph :barGraphData="classBarGraphData.finalAssignments" :chartTitle="graphTitleList.finalAssignments"></BarGraph></v-container>
          </v-window-item>
        </v-window>
      </v-container>
    </v-card-text>
  </v-card>
</template>