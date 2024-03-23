<script setup>
  import ProfileEdit from "../components/ProfileEdit.vue";
  import pageTitle from "../components/shared/pageTitle.vue";
  import BaseUI from "../components/shared/BaseUI.vue";
</script>

<template>
  <BaseUI>
    <!-- <template #header>
      <pageTitle title="プロフィールを編集する" />
    </template>
    <ProfileEdit></ProfileEdit> -->
    <v-row justify="center" align="end">
      <v-col cols="0" sm="0" md="3" lg="3" class="d-none d-md-block"><v-img :src="readingImg" alt="img" width="300px"></v-img></v-col>
      <v-col cols="12" sm="12" md="6" lg="6" class="d-flex justify-center"><ProfileEdit></ProfileEdit></v-col>
      <v-col cols="0" sm="0" md="3" lg="3" class="d-none d-md-block"><v-img :src="passwordImg" alt="img" width="300px"></v-img></v-col>
    </v-row>
  </BaseUI>
</template>
