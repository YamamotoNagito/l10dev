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
  <v-row class="mb-15">
    <v-col cols="12">
      <v-container class="d-flex flex-row justify-center align-center">
        <h2 class="text-h3 text-center">
          {{ classInformationData?.lectureName }}
        </h2>
        <v-btn class="d-flex flex-row ml-5" color="orange"
          ><v-icon>mdi-pencil</v-icon>
          <p
            class="text-h9"
            @click="
              router.push({
                name: 'class/post',
                query: {
                  lectureName: classDetailData?.classInformationData?.lectureName,
                  teacherName: classDetailData?.classInformationData?.teacherName
                }
              })
            "
          >
            レビュー投稿
          </p>
        </v-btn>
      </v-container>
      <v-expansion-panels>
        <v-expansion-panel>
          <v-expansion-panel-title> 基本情報 </v-expansion-panel-title>
          <v-expansion-panel-text>
            <ClassInformationTable
              :class-information-data="classDetailData?.classInformationData"
            ></ClassInformationTable>
            <RadarChart :radar-chart-data="classDetailData?.classRadarChartData"></RadarChart>
            <GraphTabs :class-bar-graph-data="classDetailData?.classBarGraphData"></GraphTabs>
          </v-expansion-panel-text>
        </v-expansion-panel>
      </v-expansion-panels>
      <ReviewListVue :review-data-list="classDetailData?.reviewDataList"></ReviewListVue>
    </v-col>
  </v-row>
</template>
