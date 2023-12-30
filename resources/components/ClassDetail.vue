<script setup>
import { ref } from 'vue'
import vuetify from '../js/vuetify';
import axios from 'axios';
import { useRouter } from 'vue-router'
import ReviewListVue from './ReviewList.vue';
import GraphTabs from './GraphTabs.vue';


</script>

<template>
    <v-app>
        <v-main>
            <v-container class="mx-auto mb-15">
                <GraphTabs></GraphTabs>
                <ReviewListVue></ReviewListVue>
            </v-container>
        </v-main>
    </v-app>
</template>