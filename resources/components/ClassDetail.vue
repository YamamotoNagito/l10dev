<script setup>
  import { defineProps, ref } from "vue";
  import { useRouter } from "vue-router";
  import ReviewListVue from "./ReviewList.vue";
  import GraphTabs from "./GraphTabs.vue";
  import ClassInformationTable from "./ClassInformationTable.vue";
  import RadarChart from "./RadarChart.vue";
  import BarGraph from "./BarGraph.vue"

  const { classDetailData } = defineProps(["classDetailData"]);
  const router = useRouter();

  const toggle = ref(undefined)

  const panel = ref(0)
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
            ><v-icon color="white">mdi-pencil</v-icon>
            <p
              class="text-h9 text-white"
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
          <v-expansion-panels v-model="panel">
            <v-expansion-panel>
              <v-expansion-panel-title> 基本情報 </v-expansion-panel-title>
              <v-expansion-panel-text>
                <v-row>
                  <v-col>
                    <ClassInformationTable
                      :class-information-data="classDetailData?.classInformationData"
                    ></ClassInformationTable>
                  </v-col>
                </v-row>
                <!-- 区切り線 -->
                <v-divider :thickness="1" class="border-opacity-100 my-8" color="primary"></v-divider>
                <v-row justify="center">
                  <v-col cols="12" class="d-flex justify-center">
                    <v-btn-toggle v-model="toggle" color="primary" class="d-flex flex-wrap justify-center class-v-btn-toggle">
                        <v-btn value="btn-1" rounded="xl" class="class-v-btn" height="50px">5段階評価</v-btn>
                        <v-btn value="btn-2" rounded="xl" class="class-v-btn" height="50px">みんなの成績</v-btn>
                        <v-btn value="btn-3" rounded="xl" class="class-v-btn" height="50px">出欠確認</v-btn>
                        <v-btn value="btn-4" rounded="xl" class="class-v-btn" height="50px">過去問の普及率</v-btn>
                        <v-btn value="btn-5" rounded="xl" class="class-v-btn" height="50px">日課の課題・レポート</v-btn>
                        <v-btn value="btn-6" rounded="xl" class="class-v-btn" height="50px">中間レポート・課題</v-btn>
                        <v-btn value="btn-7" rounded="xl" class="class-v-btn" height="50px">期末レポート・課題</v-btn>
                    </v-btn-toggle>
                  </v-col>
                </v-row>
                <v-row>
                  <v-col>
                    <v-window v-model="toggle">
                      <v-window-item value=btn-1>
                        <RadarChart :radar-chart-data="classDetailData?.classRadarChartData"></RadarChart>
                      </v-window-item>
                      <v-window-item value=btn-2>
                        <BarGraph :bar-graph-data="classDetailData?.classBarGraphData?.grades" chart-title="みんなの成績"></BarGraph>
                      </v-window-item>
                      <v-window-item value=btn-3>
                        <BarGraph :bar-graph-data="classDetailData?.classBarGraphData?.attendanceConfirm" chart-title="出欠確認"></BarGraph>
                      </v-window-item>
                      <v-window-item value=btn-4>
                        <BarGraph :bar-graph-data="classDetailData?.classBarGraphData?.pastExamPossesion" chart-title="過去問の普及率"></BarGraph>
                      </v-window-item>
                      <v-window-item value=btn-5>
                        <BarGraph :bar-graph-data="classDetailData?.classBarGraphData?.weeklyAssignments" chart-title="日課の課題・レポート"></BarGraph>
                      </v-window-item>
                      <v-window-item value=btn-6>
                        <BarGraph :bar-graph-data="classDetailData?.classBarGraphData?.midtermAssignments" chart-title="中間レポート・課題"></BarGraph>
                      </v-window-item>
                      <v-window-item value=btn-7>
                        <BarGraph :bar-graph-data="classDetailData?.classBarGraphData?.finalAssignments" chart-title="期末レポート・課題"></BarGraph>
                      </v-window-item>
                    </v-window>
                  </v-col>
                </v-row>
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

<style scoped>
.v-btn-group--density-default.v-btn-group{
  height: auto;
}
</style>