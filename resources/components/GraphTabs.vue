<script setup>
  import { ref, defineProps } from "vue";
  import BarGraph from "./BarGraph.vue";

  const tab = ref(null);

  const props = defineProps(["classBarGraphData"]);

  const graphTitleList = ref({
    grades: "みんなの成績",
    attendanceConfirm: "出欠確認",
    pastExamPossesion: "過去問の普及率",
    weeklyAssignments: "日課の課題・レポート",
    midtermAssignments: "中間レポート・課題",
    finalAssignments: "期末レポート・課題"
  });
</script>

<template>
  <v-card flat class="d-flex flex-column">
    <v-container class="d-flex justify-center">
      <v-tabs v-model="tab">
        <v-tab value="one">みんなの成績</v-tab>
        <v-tab value="two">出欠確認</v-tab>
        <v-tab value="three">過去問の普及率</v-tab>
        <v-tab value="four">日課の課題・レポート</v-tab>
        <v-tab value="five">中間レポート・課題</v-tab>
        <v-tab value="six">期末レポート・課題</v-tab>
      </v-tabs>
    </v-container>
    <v-card-text>
      <v-container class="d-flex justify-center">
        <v-window v-model="tab">
          <v-window-item value="one">
            <v-container
              ><BarGraph :bar-graph-data="classBarGraphData.grades" :chart-title="graphTitleList.grades"></BarGraph
            ></v-container>
          </v-window-item>
          <v-window-item value="two">
            <v-container
              ><BarGraph
                :bar-graph-data="classBarGraphData.attendanceConfirm"
                :chart-title="graphTitleList.attendanceConfirm"
              ></BarGraph
            ></v-container>
          </v-window-item>
          <v-window-item value="three">
            <v-container
              ><BarGraph
                :bar-graph-data="classBarGraphData.pastExamPossesion"
                :chart-title="graphTitleList.pastExamPossesion"
              ></BarGraph
            ></v-container>
          </v-window-item>
          <v-window-item value="four">
            <v-container
              ><BarGraph
                :bar-graph-data="classBarGraphData.weeklyAssignments"
                :chart-title="graphTitleList.weeklyAssignments"
              ></BarGraph
            ></v-container>
          </v-window-item>
          <v-window-item value="five">
            <v-container
              ><BarGraph
                :bar-graph-data="classBarGraphData.midtermAssignments"
                :chart-title="graphTitleList.midtermAssignments"
              ></BarGraph
            ></v-container>
          </v-window-item>
          <v-window-item value="six">
            <v-container
              ><BarGraph
                :bar-graph-data="classBarGraphData.finalAssignments"
                :chart-title="graphTitleList.finalAssignments"
              ></BarGraph
            ></v-container>
          </v-window-item>
        </v-window>
      </v-container>
    </v-card-text>
  </v-card>
</template>
