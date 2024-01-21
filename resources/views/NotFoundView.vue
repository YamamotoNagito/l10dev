<script setup>
import { useRouter } from "vue-router";

const router = useRouter()
</script>


<template>
    <v-container class="d-flex flex-column">
        <p class="text-center text-h5">ページが存在しません</p>
        <v-btn rounded max-width="150px" class="mx-auto" @click="router.push('/welcome')">ホームに戻る</v-btn>
    </v-container>
</template>