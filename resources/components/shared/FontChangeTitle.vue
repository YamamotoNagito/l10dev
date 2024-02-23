<!-- Title.vue -->
<template>
  <div id="title-block">
    <p :style="{ fontSize: fontSize, fontFamily: 'Kaisei' }" class="text-white">
      <slot></slot>
    </p>
  </div>
</template>

<script setup>
  import { ref, watch, onMounted } from "vue";
  import { useDisplay } from "vuetify";

  const { xs, sm, md, lg, xl, xxl } = useDisplay();
  const fontSize = ref("");

  // text-h◯とfontの変更は同時に使用できないため，fontSizeを使用する
  const fontSizeMap = {
    xxl: "2.8rem",
    xl: "2.4rem",
    lg: "2.0rem",
    md: "1.8rem",
    sm: "1.5rem",
    xs: "1.2rem",
    default: "0.8rem"
  };

  const setFontSize = () => {
    if (xxl.value) {
      fontSize.value = fontSizeMap.xxl;
    } else if (xl.value) {
      fontSize.value = fontSizeMap.xl;
    } else if (lg.value) {
      fontSize.value = fontSizeMap.lg;
    } else if (md.value) {
      fontSize.value = fontSizeMap.md;
    } else if (sm.value) {
      fontSize.value = fontSizeMap.sm;
    } else if (xs.value) {
      fontSize.value = fontSizeMap.xs;
    } else {
      fontSize.value = fontSizeMap.default;
    }
  };

  onMounted(setFontSize);

  watch([xs, sm, md, lg, xl, xxl], setFontSize);
</script>

<style>
  #title-block {
    display: flex;
    justify-content: center;
    align-items: center;
  }
</style>
