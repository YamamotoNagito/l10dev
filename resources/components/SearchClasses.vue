<script setup>
import { ref } from "vue";
import { useRouter } from 'vue-router'

const router = useRouter();

const tab = ref(null);

const searchClassByDetailedCondition = ref({
  lectureName: null,
  teacherName: null,
  place: null,
  department: null,
  classification: null,
  day: null,
  time: null,
  grade: null,
  totalEvaluation: null,
  ease: null,
  interesting: null,
  qualityOfTeacher: null,
  support: null,
  skill: null,
});

const searchClassByLectureCode = ref({
  lectureCode: null,
});

const nonExistenceMessage = ref("")

const searchByDetailedCondition = () => {
  console.log(searchClassByDetailedCondition.value);
};

const searchByLectureCode = async() => {
  try {
    // const response = await axios.post("/api/register", data);
    // console.log("response")
    // data['lectureId'] = response.data.lectureId;
    const lectureId = 1243
    const dataExists = false
    if(dataExists){
      nonExistenceMessage.value = ""
      router.push({path : `class/${lectureId}/detail`}, {params : lectureId})
    }else{
      nonExistenceMessage.value = "存在しない講義コードです．"
    }
    

  // その他の処理
  } catch (error) {
    console.log("error is observed ( ﾟДﾟ)")
    // if (error.response) {
    //   // サーバーからのエラーレスポンスがある場合
    //   console.error(error.response.data); // エラーレスポンスをコンソールに出力
    // } else {
    //   // リクエストがサーバーに届かなかった場合など
    //   console.error(error.message);
    // }
  }  
};
</script>



<template>
  <v-container class="mb-16">
    <v-row justify="center">
      <v-card width="900px">
        <v-tabs
          v-model="tab"
          align-tabs="center"
          bg-color="orange"
          height="60px"
        >
          <v-tab value="one"
            ><v-content class="tab-name">条件で探す</v-content></v-tab
          >
          <v-tab value="two"
            ><v-content class="tab-name">講義コードで探す</v-content></v-tab
          >
        </v-tabs>

        <v-card-text>
          <v-window v-model="tab">
            <v-window-item value="one">
              <v-container class="category-name-and-content-container">
                <p class="category-name">授業名</p>
                <v-text-field
                  placeholder="一攫千金特論"
                  class="input-field"
                  v-model="searchClassByDetailedCondition.lectureName"
                ></v-text-field>
              </v-container>
              <v-container class="category-name-and-content-container">
                <p class="category-name">担当教員名</p>
                <v-text-field
                  placeholder="服部淳生"
                  class="input-field"
                  v-model="searchClassByDetailedCondition.teacherName"
                ></v-text-field>
              </v-container>
              <!-- 他の条件についても同様にコードを追加 -->

              <v-expansion-panels class="mb-4">
                <v-expansion-panel>
                  <v-expansion-panel-title
                    >より詳しい条件で探す</v-expansion-panel-title
                  >
                  <v-expansion-panel-text>
                    <v-container
                      class="detailed-totalEvaluationList-list-container"
                    >
                      <!-- 以下、他の条件の追加 -->
                      <v-container class="category-name-and-content-container">
                        <p class="category-name">開講場所</p>
                        <v-select
                          :items="placeList"
                          v-model="searchClassByDetailedCondition.place"
                          class="pulldown-list"
                        ></v-select>
                      </v-container>

                      <v-container class="category-name-and-content-container">
                        <p class="category-name">開講部局</p>
                        <v-select
                          :items="departmentList"
                          v-model="searchClassByDetailedCondition.department"
                          class="pulldown-list"
                        ></v-select>
                      </v-container>

                      <v-container class="category-name-and-content-container">
                        <p class="category-name">開講区分</p>
                        <v-select
                          :items="classificationList"
                          v-model="
                            searchClassByDetailedCondition.classification
                          "
                          class="pulldown-list"
                        ></v-select>
                      </v-container>

                      <v-container class="category-name-and-content-container">
                        <p class="category-name">曜日</p>
                        <v-select
                          :items="dayList"
                          v-model="searchClassByDetailedCondition.day"
                          class="pulldown-list"
                        ></v-select>
                      </v-container>

                      <v-container class="category-name-and-content-container">
                        <p class="category-name">時間</p>
                        <v-select
                          :items="timeList"
                          v-model="searchClassByDetailedCondition.time"
                          class="pulldown-list"
                        ></v-select>
                      </v-container>

                      <v-container class="category-name-and-content-container">
                        <p class="category-name">履修年次</p>
                        <v-select
                          :items="gradeList"
                          v-model="searchClassByDetailedCondition.grade"
                          class="pulldown-list"
                        ></v-select>
                      </v-container>

                      <v-container class="category-name-and-content-container">
                        <p class="category-name">総合評価</p>
                        <v-select
                          :items="totalEvaluationList"
                          v-model="
                            searchClassByDetailedCondition.totalEvaluation
                          "
                          class="pulldown-list"
                        ></v-select>
                      </v-container>

                      <v-container class="category-name-and-content-container">
                        <p class="category-name">単位取得のしやすさ</p>
                        <v-select
                          :items="totalEvaluationList"
                          v-model="searchClassByDetailedCondition.ease"
                          class="pulldown-list"
                        ></v-select>
                      </v-container>

                      <v-container class="category-name-and-content-container">
                        <p class="category-name">面白さ</p>
                        <v-select
                          :items="totalEvaluationList"
                          v-model="searchClassByDetailedCondition.interesting"
                          class="pulldown-list"
                        ></v-select>
                      </v-container>

                      <v-container class="category-name-and-content-container">
                        <p class="category-name">教員の質</p>
                        <v-select
                          :items="totalEvaluationList"
                          v-model="
                            searchClassByDetailedCondition.qualityOfTeacher
                          "
                          class="pulldown-list"
                        ></v-select>
                      </v-container>

                      <v-container class="category-name-and-content-container">
                        <p class="category-name">サポート体制</p>
                        <v-select
                          :items="totalEvaluationList"
                          v-model="searchClassByDetailedCondition.support"
                          class="pulldown-list"
                        ></v-select>
                      </v-container>

                      <v-container class="category-name-and-content-container">
                        <p class="category-name">スキルが身につくか</p>
                        <v-select
                          :items="totalEvaluationList"
                          v-model="searchClassByDetailedCondition.skill"
                          class="pulldown-list"
                        ></v-select>
                      </v-container>
                      <!-- 他の条件の追加ここまで -->
                    </v-container>
                  </v-expansion-panel-text>
                </v-expansion-panel>
              </v-expansion-panels>

              <v-btn @click="searchByDetailedCondition" color="orange">
                <v-icon start icon="mdi-checkbox-marked-circle"></v-icon>検索
              </v-btn>
            </v-window-item>

            <v-window-item value="two">
              <v-container class="category-and-content-container">
                <p class="category-name">講義コード</p>
                <v-text-field
                  placeholder="KA*******"
                  v-model="searchClassByLectureCode.lectureCode"
                ></v-text-field>
              </v-container>
              <v-container class="d-flex">
                <v-btn @click="searchByLectureCode" color="orange">
                  <v-icon start icon="mdi-checkbox-marked-circle"></v-icon>検索
                </v-btn>
                <p class="text-red text-center">{{ nonExistenceMessage }}</p>
              </v-container>
            </v-window-item>
          </v-window>
        </v-card-text>
      </v-card>
    </v-row>
  </v-container>
</template>

<style scoped>
.category-name {
  font-size: 1.3rem;
}
.tab-name {
  font-size: 1.3rem;
}
</style>
