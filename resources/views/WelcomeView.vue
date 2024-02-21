<script setup>
  import SearchClasses from "../components/SearchClasses.vue";
  import BaseUI from "../components/shared/BaseUI.vue";
</script>

<template>
  <BaseUI>
    <template #header>
      <v-container class="pb-8 bg-primary" fluid>
        <div id="title-block">
          <p class="text-h6 text-md-h4 text-lg-h4">大学生による授業評価をオープンに</p>
        </div>
      </v-container>
    </template>
    <SearchClasses></SearchClasses>
  </BaseUI>
</template>

<style>
  #title-block {
    display: flex;
    justify-content: center; /*左右中央*/
    align-items: center; /*上下中央*/
  }
</style>
