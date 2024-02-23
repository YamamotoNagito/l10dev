<script setup>
  import { ref, watch, onMounted } from "vue";
  import { useDisplay } from "vuetify";
  import Welcome from "../components/Welcome.vue";
  import SearchClasses from "../components/SearchClasses.vue";
  import BaseUI from "../components/shared/BaseUI.vue";
  import FontChangeTitle from "../components/shared/FontChangeTitle.vue";

  const { xs, sm, md, lg, xl, xxl } = useDisplay();
  const fontSize = ref("");

  // text-h◯とfontの変更は同時に使用できないため，fontSizeを使用する
  const setFontSize = () => {
    if (xxl.value) {
      fontSize.value = "2.8rem";
    } else if (xl.value) {
      fontSize.value = "2.4rem";
    } else if (lg.value) {
      fontSize.value = "2.0rem";
    } else if (md.value) {
      fontSize.value = "1.8rem";
    } else if (sm.value) {
      fontSize.value = "1.5rem";
    } else if (xs.value) {
      fontSize.value = "1.2rem";
    } else {
      fontSize.value = "0.8rem";
    }
  };

  onMounted(setFontSize);

  // ブレークポイントが変更されたときにフォントサイズを更新
  watch([xs, sm, md, lg, xl, xxl], setFontSize);
</script>

<template>
  <v-container class="pb-8 bg-primary" fluid>
    <FontChangeTitle>
      大学生による授業評価を、オープンに。
      <!-- ~広大生の学びを支える情報サイト~ -->
    </FontChangeTitle>
  </v-container>
  </template>
  <Welcome></Welcome>
  <SearchClasses></SearchClasses>
</template>
