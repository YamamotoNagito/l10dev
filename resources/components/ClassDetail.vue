<script setup>
  import { defineProps } from "vue";
  import { useRouter } from "vue-router";
  import ReviewListVue from "./ReviewList.vue";
  import GraphTabs from "./GraphTabs.vue";
  import ClassInformationTable from "./ClassInformationTable.vue";
  import RadarChart from "./RadarChart.vue";

  const { classDetailData } = defineProps(["classDetailData"]);
  const router = useRouter();
</script>

<template>
  <v-row class="mb-15">
    <v-col cols="12">
      <v-row justify="center">
        <v-col cols="12">
          <h2 class="text-h3 text-center">
            {{ classDetailData?.classInformationData?.lectureName }}
          </h2>
        </v-col>
        <v-col cols="12" class="d-flex flex-row justify-center">
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
        </v-col>
      </v-row>
      <v-row>
        <v-col v-if="classDetailData">
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
        </v-col>
        <v-col v-else>
          <p>データを取得できませんでした．</p>
        </v-col>
      </v-row>
      <ReviewListVue :review-data-list="classDetailData?.reviewDataList"></ReviewListVue>
    </v-col>
  </v-row>
</template>
