<template>
  <v-alert
    v-if="message"
    :type="type"
    class="my-6 alert-high-z-index responsive-min-width"
    closable
    close-label="Close Alert"
    location="top center"
    position="fixed"
    elevation="24"
  >
    {{ message }}
  </v-alert>
</template>

<script>
  export default {
    props: {
      message: {
        type: String,
        default: ""
      },
      type: {
        type: String,
        default: "info"
      }
    }
  };
</script>

<style>
  /* カスタムCSSクラスでz-indexを設定。ヘッダーと被らないようにするため。 */
  .alert-high-z-index {
    z-index: 10000;
  }
  /* デフォルトのmin-widthはPC用 */
  .responsive-min-width {
    min-width: 45rem;
  }

  /* 画面幅が768px以下の場合、スマホ用のmin-widthを適用 */
  @media (max-width: 768px) {
    .responsive-min-width {
      min-width: 20rem;
    }
  }
</style>
