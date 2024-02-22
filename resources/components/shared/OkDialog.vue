<script setup>
  import { defineProps, defineEmits } from "vue";

  const props = defineProps({
    showDialog: Boolean,
    messageInDialog: String
  });
  const emits = defineEmits(["toggleShowDialog"]);

  const closeDialog = () => {
    emits("toggleShowDialog");
  };
</script>

<template>
  <v-dialog v-model="props.showDialog" persistent max-width="400px" max-height="400px">
    <v-card>
      <v-card-text>
        <v-row no-gutters>
          <v-col cols="1">
            <v-icon icon="mdi-alert" color="red"></v-icon>
          </v-col>
          <v-col cols="11">
            <p class="text-center text-red">{{ messageInDialog }}</p>
          </v-col>
        </v-row>
        <v-row no-gutters>
          <v-col class="d-flex justify-center pt-0">
            <v-btn class="mt-4" color="primary" flat @click="closeDialog">
              <p class="text-white">OK</p>
            </v-btn>
          </v-col>
        </v-row>
      </v-card-text>
    </v-card>
  </v-dialog>
</template>
