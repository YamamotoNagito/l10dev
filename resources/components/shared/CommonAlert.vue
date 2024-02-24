<template>
  <v-alert
    v-if="message"
    :type="type"
    class="my-6 alert-high-z-index"
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
</style>
