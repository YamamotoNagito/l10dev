<script setup>
import { ref } from 'vue'
import vuetify from '../js/vuetify';
import axios from 'axios';
import { useRouter } from 'vue-router'

</script>

<template>
    <v-app>
        <v-main>
            <!-- <v-container>
                <p>ここに記述をしていく</p>
                <p>ClassList</p>
            </v-container> -->

            <!-- <v-sheet height="200px"      
            max-width="500px"
            class="bg-red-lighten-3 rounded-lg"
            elevation="3"> -->
            <v-sheet class="bg-red-lighten-3 rounded-lg" top="200px" height="500px">
                <span>height 指定は有効</span><br/>
                <span>max-width 指定は有効</span><br/>
                <span>デフォルトでpaddingが設定されていない</span><br/>
                <span>影(elevation) の指定ができる</span><br/>
                <span>背景色、文字色の指定は class で行う</span><br/>
                <span>角(rounded)の指定は有効</span><br/>
            </v-sheet>

        </v-main>
    </v-app>
</template>

<style>

</style>