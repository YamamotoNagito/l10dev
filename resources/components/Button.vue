<script setup>

import { ref, defineProps, defineEmits } from 'vue'
const props = defineProps(['title'])
const emits = defineEmits(['click'])

// クリックされた時に呼ばれるメソッド
const click = () => {
  
  console.log('ボタンがクリックされました');
  emits('click')
};
</script>


<template>
    <div>
        <v-btn @click="click()">
        {{ title }}
        </v-btn>
    </div>
</template>

<style>
</style>