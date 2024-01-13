<script setup>
import {ref, onMounted, getCurrentInstance} from 'vue'
import ClassDetail from '../components/ClassDetail.vue'

const lectureId = ref(null)

onMounted(() => {
    // contextから$routeを取得する
    const { $route } = getCurrentInstance().appContext.config.globalProperties;
    lectureId.value = $route.params.lectureId
    console.log(`lecture id is ${lectureId.value}`)
})
</script>

<template>
    <ClassDetail></ClassDetail>
</template>