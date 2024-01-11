<template>
  <v-row justify="center">
    <v-col cols="8">
      <v-row>
        <v-col>
          <p class="text-h6">授業名</p>
          <v-text-field
            placeholder="一攫千金特論"
            class="input-field"
            v-model="searchContents.lectureName"
          ></v-text-field>
          <p class="text-h6">担当教員名</p>
          <v-text-field
            placeholder="服部淳生"
            class="input-field"
            v-model="searchContents.teacherName"
          ></v-text-field>
        </v-col>
      </v-row>
      <!-- 受講年度 -->
      <v-row>
        <v-col>
          <!-- sm(600px)未満の場合でも文字サイズが小さくなる？ -->
          <p class="custom-text-style">受講年度</p>
        </v-col>
      </v-row>
      <v-btn-toggle v-model="attendYear" variant="outlined" class="full-height">
        <v-row no-gutters class="my-2">
          <v-col
            v-for="option in attendYearOptions"
            :key="option.value"
            cols="4"
              sm="2"
              md="2"
              lg=""
              xl=""
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
          <p class="custom-text-style">出席の有無</p>
        </v-col>
      </v-row>
      <v-btn-toggle v-model="attendanceConfirm" variant="outlined" class="full-height">
        <v-row no-gutters  class="my-2">
          <v-col
            cols="4"
            sm=""
            md=""
            lg=""
            xl=""
            v-for="option in attendanceConfirmOptions"
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
      <!-- 毎回のレポート・テスト -->
      <v-row class="mt-5">
        <v-col>
          <p class="custom-text-style">毎回のレポート・テスト</p>
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
      <!-- 中間のレポート・テスト -->
      <v-row class="mt-5">
        <v-col>
          <p class="custom-text-style">中間のレポート・テスト</p>
        </v-col>
      </v-row>
      <v-btn-toggle v-model="midtermAssignments" variant="outlined" class="full-height">
        <v-row no-gutters class="my-2">
          <v-col
            cols=""
            sm=""
            md=""
            lg=""
            v-for="option in midtermAssignmentsOptions"
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
      <!-- 期末のレポート・テスト -->
      <v-row class="mt-5">
        <v-col>
          <p class="custom-text-style">期末のレポート・テスト</p>
        </v-col>
      </v-row>
      <v-btn-toggle v-model="finalAssignments" variant="outlined" class="full-height">
        <v-row no-gutters class="my-2">
          <v-col
            cols=""
            sm=""
            md=""
            lg=""
            v-for="option in finalAssignmentsOptions"
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
      <!-- 過去問・レポートの有無 -->
      <v-row class="mt-5">
        <v-col>
          <p class="custom-text-style">過去問・レポートの有無</p>
        </v-col>
      </v-row>
      <v-btn-toggle v-model="pastExamPossession" variant="outlined" class="full-height">
        <v-row no-gutters class="my-2">
          <v-col
            cols=""
            sm=""
            md=""
            lg=""
            v-for="option in pastExamPossessionOptions"
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
      <!-- 成績 -->
      <v-row class="mt-5">
        <v-col>
          <p class="custom-text-style">成績</p>
        </v-col>
      </v-row>
      <v-btn-toggle v-model="grades" variant="outlined" class="full-height">
        <v-row no-gutters class="my-2">
          <v-col
            cols=""
            sm=""
            md=""
            lg=""
            v-for="option in gradesOptions"
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
      <!-- 単位取得のしやすさ -->
      <v-row class="mt-5">
        <v-col>
          <p class="custom-text-style">単位取得のしやすさ</p>
        </v-col>
      </v-row>
      <v-btn-toggle v-model="creditLevel" variant="outlined" class="full-height">
        <v-row no-gutters class="my-2">
          <v-col
            cols=""
            sm=""
            md=""
            lg=""
            v-for="option in creditLevelOptions"
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
      <!-- 面白さ -->
      <v-row class="mt-5">
        <v-col>
          <p class="custom-text-style">面白さ</p>
        </v-col>
      </v-row>
      <v-btn-toggle v-model="interestLevel" variant="outlined" class="full-height">
        <v-row no-gutters class="my-2">
          <v-col
            cols=""
            sm=""
            md=""
            lg=""
            v-for="option in interestLevelOptions"
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
      <!-- スキル習得 -->
      <v-row class="mt-5">
        <v-col>
          <p class="custom-text-style">スキル習得</p>
        </v-col>
      </v-row>
      <v-btn-toggle v-model="skillLevel" variant="outlined" class="full-height">
        <v-row no-gutters class="my-2">
          <v-col
            cols=""
            sm=""
            md=""
            lg=""
            v-for="option in skillLevelOptions"
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
      <!-- コメント -->
      <v-row class="mt-5">
        <v-col>
          <p class="custom-text-style">コメント</p>
        </v-col>
      </v-row>
      <v-row>
        <v-col>
          <v-textarea
            variant="outlined"
            v-model="comments"
            auto-grow
          ></v-textarea>
        </v-col>
      </v-row>
      <v-row >
        <v-col class="text-center custom-text-style">
          <v-btn
            @click="clickButton"
            text="投稿する"
            color="indigo"
          ></v-btn>
        </v-col>
      </v-row>
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

const searchContents = ref({
  // 授業名
  lectureName: null,
  // 担当教員名
  teacherName: null,
});


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
const pastExamPossession = ref("なし");
const pastExamPossessionOptions = ref([
  { label: "なし", value: "なし" },
  { label: "過去問＋過去レポート", value: "レポ問" },
  { label: "過去問のみ", value: "過去問" },
  { label: "過去レポートのみ", value: "過去レポート" },
]);

const grades = ref("秀");
const gradesOptions = ref([
  { label: "秀", value: "秀" },
  { label: "優", value: "優" },
  { label: "良", value: "良" },
  { label: "可", value: "可" },
  { label: "不可", value: "不可" },
]);

const creditLevel = ref("3");
const creditLevelOptions = ref([
  { label: "激難", value: "1" },
  { label: "難", value: "2" },
  { label: "普通", value: "3" },
  { label: "楽", value: "4" },
  { label: "超楽", value: "5" },
]);

const interestLevel = ref("3");
const interestLevelOptions = ref([
  { label: "まったく面白くない", value: "1" },
  { label: "面白くない", value: "2" },
  { label: "普通", value: "3" },
  { label: "面白い", value: "4" },
  { label: "とても面白い", value: "5" },
]);

// ラベル後回し
const skillLevel = ref("3");
const skillLevelOptions = ref([
  { label: "まったく役に立たない", value: "1" },
  { label: "あまり役に立たない", value: "2" },
  { label: "普通", value: "3" },
  { label: "役立つ", value: "4" },
  { label: "とても役立つ", value: "5" },
]);

const comments = ref('');

// 画面サイズに合わせてボタンのサイズを返す
const { name } = useDisplay()
const btnSize = computed(() => {
  switch (name.value) {
    case 'xs': return 'small';
    case 'sm': return 'small';
    case 'md': return 'default';
    case 'lg': return 'default';
    case 'xl': return 'default';
    case 'xxl': return 'default';
  }
  return 'default';
})

const clickButton = async() => {
  console.log("クリックされたで");

  const data = {
    lectureName: "一攫千金特論",
    teacherName: "服部淳生",
    attendYear:attendYear.value,
    attendanceConfirm:attendanceConfirm.value,
    weeklyAssignments:weeklyAssignments.value,
    midtermAssignments:midtermAssignments.value,
    finalAssignments:finalAssignments.value,
    pastExamPossession:pastExamPossession.value,
    grades:grades.value,
    creditLevel: creditLevel.value,
    interestLevel: interestLevel.value,
    skillLevel: skillLevel.value,
    comments: comments.value,
  }

try {
    await axios.post("/api/reviews", data);
    router.push('/reviews')

  // その他の処理
  } catch (error) {
    if (error.response) {
      // サーバーからのエラーレスポンスがある場合
      console.error(error.response.data); // エラーレスポンスをコンソールに出力
    } else {
      // リクエストがサーバーに届かなかった場合など
      console.error(error.message);
    }
  }
};

</script>

<style>
  .v-btn {
    margin: 0 10px;
  }
  .full-height {
    height: auto !important;
  }
  .custom-text-style {
  @apply text-md-h5 text-sm-h6;
}

</style>

