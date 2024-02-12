<script setup>
import ProfileEdit from "../components/ProfileEdit.vue";
import pageTitle from "../components/pageTitle.vue";
import BaseUI from "../components/shared/BaseUI.vue";
</script>

<template>
  <BaseUI>
    <template v-slot:header>
      <pageTitle title="プロフィールを編集する" />
    </template>
    <ProfileEdit></ProfileEdit>
  </BaseUI>
</template>
