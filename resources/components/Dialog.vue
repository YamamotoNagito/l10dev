<script setup>
import { defineProps, defineEmits } from "vue"

const props = defineProps(["showDialog", "messageInDialog"])
const emits = defineEmits(["toggleShowDialog"])
</script>

<template>
    <v-dialog v-model="props.showDialog" persistent width="320px" @click="emits('toggleShowDialog')">
        <v-card>
            <v-row>
                <v-col cols="1">
                    <v-card-text>
                    <v-icon icon="mdi-alert" color="red"></v-icon>
                    </v-card-text>
                </v-col>
                <v-col cols="11">
                    <v-card-text><p class="text-center text-red">
                            {{ messageInDialog }}
                    </p></v-card-text>
                </v-col>
            </v-row>
        </v-card>
    </v-dialog>
</template>
