<script setup>
import { ref } from 'vue'
import vuetify from '../../js/vuetify';
import axios from 'axios';
import { useRouter } from 'vue-router'
import ClassPostSelectButton from './ClassPostSelect.vue';

</script>

<script>
export default {
  data: () => ({
    // ここから検索に関する変数
    // 検索事項のリスト。検索するときはこれをbackendに投げる
    searchContents: {
      // 授業名
      lectureName: null,
      // 担当教員名
      teacherName: null,
    },
  }),
};
</script>

<template>
  <!-- 授業検索 -->
  <v-sheet>
      <v-row justify="center">
        <v-col cols="8">
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
    </v-sheet>
</template>
