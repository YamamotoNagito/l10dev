<script setup>
  import { defineProps } from "vue";
  import { ref, watch, onMounted } from "vue";
  import { useDisplay } from "vuetify";
  import kaedeMainImg from "../../assets/img/kaedeKey.png";

  const propData = defineProps({
    title: String
  });
  // console.log("loaded.");

  const { xs, sm, md, lg, xl, xxl } = useDisplay();
  const imageSize = ref("50px"); // 画像サイズの初期値

  const setImageSize = () => {
    if (xxl.value) {
      imageSize.value = "100px"; // XXLの場合の画像サイズ
    } else if (xl.value) {
      imageSize.value = "90px"; // XLの場合の画像サイズ
    } else if (lg.value) {
      imageSize.value = "80px"; // LGの場合の画像サイズ
    } else if (md.value) {
      imageSize.value = "70px"; // MDの場合の画像サイズ
    } else if (sm.value) {
      imageSize.value = "60px"; // SMの場合の画像サイズ
    } else if (xs.value) {
      imageSize.value = "50px"; // XSの場合の画像サイズ
    } else {
      imageSize.value = "40px"; // それ以外の場合の画像サイズ
    }
  };

  onMounted(setImageSize);
  watch([xs, sm, md, lg, xl, xxl], setImageSize);
</script>

<template>
  <v-container class="mt-5">
    <div id="title-block">
      <img :src="kaedeMainImg" alt="kaedeMainImg" :width="imageSize" :height="imageSize" />
      <p class="text-h5 text-md-h4 text-lg-h4">{{ propData.title }}</p>
      <img :src="kaedeMainImg" alt="kaedeMainImg" :width="imageSize" :height="imageSize" />
    </div>
  </v-container>
</template>

<style></style>
