<!-- BaseUI.vue -->
<template>
  <!-- 上下左右にmarginをつける -->
  <div class="pb-12 px-12">
    <!-- header スロット -->
    <div class="py-6">
      <slot name="header"></slot>
    </div>
    <!-- メインコンテンツのスロット -->
    <slot></slot>
  </div>
</template>

<script>
export default {
  name: "BaseUI",
};
</script>
