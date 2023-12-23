<script setup>
import Welcome from '../components/Welcome.vue'
// import SearchClassesView from '../components/SearchClassesView.vue';
onMounted(() => {
    console.log("this is onmounted in welcome")
})
</script>

<template>
    <Welcome></Welcome>
    <!-- <SearchClassesView></SearchClassesView> -->
</template>