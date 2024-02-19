<!-- BaseUI.vue -->
<template>
  <!-- 上下左右に padding をつける -->
  <div class="pb-12 px-sm-3 px-md-12 px-lg-12">
    <!-- header スロット -->
    <div>
      <slot name="header"></slot>
    </div>
    <!-- メインコンテンツのスロット -->
    <slot></slot>
  </div>
</template>
