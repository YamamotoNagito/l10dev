<!-- BaseUI.vue -->
<template>
  <!-- 上下左右に padding をつける -->
  <div class="pb-12 px-12">
    <!-- header スロット -->
    <div class="py-6">
      <slot name="header"></slot>
    </div>
    <!-- メインコンテンツのスロット -->
    <slot></slot>
  </div>
</template>
