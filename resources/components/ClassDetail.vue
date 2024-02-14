<script setup>
import { defineProps } from "vue";
import { useRouter } from "vue-router";
import ReviewListVue from "./ReviewList.vue";
import GraphTabs from "./GraphTabs.vue";
import ClassInformationTable from "./ClassInformationTable.vue";
import RadarChart from "./RadarChart.vue";

const props = defineProps(["classDetailData"]);
const router = useRouter();

const classDetailData = props.classDetailData;
</script>

<template>
  <v-container class="ma-auto mb-15">
    <v-container class="d-flex flex-row justify-center align-center">
      <h2 class="text-h3 text-center">
        {{ classInformationData?.lectureName }}
      </h2>
      <v-btn class="d-flex flex-row ml-5" color="orange"
        ><v-icon>mdi-comment-plus</v-icon>
        <p
          @click="
            router.push({
              name: 'class/post',
              query: {
                lectureName: classDetailData?.classInformationData?.lectureName,
                teacherName: classDetailData?.classInformationData?.teacherName,
              },
            })
          "
          class="text-h9"
        >
          レビュー投稿
        </p>
      </v-btn>
    </v-container>
    <v-expansion-panels class="ma-auto w-75">
      <v-expansion-panel>
        <v-expansion-panel-title> 基本情報 </v-expansion-panel-title>
        <v-expansion-panel-text>
          <ClassInformationTable
            :classInformationData="classDetailData?.classInformationData"
          ></ClassInformationTable>
          <RadarChart
            :radarChartData="classDetailData?.classRadarChartData"
          ></RadarChart>
        </v-expansion-panel-text>
      </v-expansion-panel>
    </v-expansion-panels>
    <GraphTabs
      :classBarGraphData="classDetailData?.classBarGraphData"
    ></GraphTabs>
    <ReviewListVue
      :reviewDataList="classDetailData?.reviewDataList"
    ></ReviewListVue>
  </v-container>
</template>
