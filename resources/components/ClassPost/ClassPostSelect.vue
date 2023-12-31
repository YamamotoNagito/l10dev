<script setup>
import { ref } from 'vue'
import vuetify from '../../js/vuetify';
import axios from 'axios';
import { useRouter } from 'vue-router'

</script>

<template>
    <v-container class="mb-16">
        <v-row justify="center">
            <v-btn-toggle
                v-model="toggle"
                divided
            >
                <v-btn icon="mdi-format-align-left"></v-btn>
                <v-btn icon="mdi-format-align-center"></v-btn>
                <v-btn icon="mdi-format-align-right"></v-btn>
                <v-btn icon="mdi-format-align-justify"></v-btn>
            </v-btn-toggle>
        </v-row>
    </v-container>
  </template>
