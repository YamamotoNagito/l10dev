<script setup>
import { ref } from 'vue'
import vuetify from '../../js/vuetify';
import axios from 'axios';
import { useRouter } from 'vue-router'
import ClassPostSelectRadio from './ClassPostSelectRadio.vue';
import ClassPostSelectButton from './ClassPostSelectButton.vue';

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
  <v-container class="mb-16">
    <v-row justify="center">
      <v-card width="900px">
        <v-card-text>
            <v-container>
              <p class="category-name">授業名</p>
              <v-text-field
                placeholder="一攫千金特論"
                class="input-field"
                v-model="searchContents.lectureName"
              ></v-text-field>
            </v-container>
            <v-container>
              <p class="category-name">担当教員名</p>
              <v-text-field
                placeholder="服部淳生"
                class="input-field"
                v-model="searchContents.teacherName"
              ></v-text-field>
            </v-container>
            <v-divider
              :thickness="5"
              class="border-opacity-50"
              color="warning"
            ></v-divider>
            <ClassPostSelectRadio></ClassPostSelectRadio>
            <ClassPostSelectButton></ClassPostSelectButton>
        </v-card-text>
      </v-card>
    </v-row>
  </v-container>
</template>

<style scoped>
.category-name {
  font-size: 1.3rem;
}
</style>
