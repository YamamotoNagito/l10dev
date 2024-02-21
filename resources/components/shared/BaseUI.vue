<!-- BaseUI.vue -->
<template>
  <!-- 上下左右に padding をつける -->
  <div class="pb-12">
    <!-- header スロット -->
    <div>
      <slot name="header"></slot>
    </div>
    <!-- メインコンテンツのスロット -->
    <slot></slot>
  </div>
</template>
