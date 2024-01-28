<script setup>
import { ref, defineProps } from "vue";
import vuetify from "../js/vuetify";
import axios from "axios";
import { useRouter } from "vue-router";
import ReviewListVue from "./ReviewList.vue";
import GraphTabs from './GraphTabs.vue';
import ClassInformationTable from "./ClassInformationTable.vue";
import RadarChart from "./RadarChart.vue";

const props = defineProps(["classDetailData"]);
const router = useRouter();

const classInformationData = props.classDetailData.classInformationData
const classRadarChartData = props.classDetailData.classRadarChartData
const classBarGraphData = props.classDetailData.classBarGraphData
const reviewDataList = props.classDetailData.reviewDataList

</script>

<template>
  <v-app>
    <v-main>
      <v-container class="ma-auto mb-15">
        <v-container class="d-flex flex-row justify-center align-center">
            <h2 class="text-h3 text-center">{{ classInformationData.lectureName }}</h2>
            <v-btn
              class="d-flex flex-row ml-5"
              color="orange"
              ><v-icon>mdi-comment-plus</v-icon>
              <p
                @click="
                  router.push({
                    name: 'class/post',
                    query: {
                      lectureName: classInformationData.lectureName,
                      teacherName: classInformationData.teacherName,
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
                :classInformationData="classInformationData"
              ></ClassInformationTable>
              <RadarChart :radarChartData="classRadarChartData"></RadarChart>
            </v-expansion-panel-text>
          </v-expansion-panel>
        </v-expansion-panels>
        <GraphTabs :classBarGraphData="classBarGraphData"></GraphTabs>
        <ReviewListVue :reviewDataList="reviewDataList"></ReviewListVue>
      </v-container>
    </v-main>
  </v-app>
</template>