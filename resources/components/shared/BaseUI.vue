<!-- BaseUI.vue -->
<template>
  <!-- 下に padding をつける -->
  <v-container class="pb-12">
    <!-- header スロット -->
    <div>
      <slot name="header"></slot>
    </div>
    <!-- メインコンテンツのスロット -->
    <slot></slot>
  </v-container>
</template>
