<script setup>
  import { defineProps, defineEmits } from "vue";

  const props = defineProps({
    isDialogVisible: Boolean,
    messageInDialog: String,
    okButtonText: {
      type: String,
      default: "OK"
    },
    cancelButtonText: {
      type: String,
      default: "キャンセル"
    }
  });
  const emits = defineEmits(["update:isDialogVisible", "confirm", "cancel"]);

  const handleConfirm = () => {
    emits("confirm");
    emits("update:isDialogVisible", false);
  };

  const handleCancel = () => {
    emits("cancel");
    emits("update:isDialogVisible", false);
  };
</script>

<template>
  <v-dialog v-model="props.isDialogVisible" persistent max-width="400px">
    <v-card>
      <v-card-text>
        <v-row no-gutters>
          <v-col cols="12">
            <p class="text-center">{{ messageInDialog }}</p>
          </v-col>
        </v-row>
        <v-row no-gutters>
          <v-col class="d-flex justify-center pt-0">
            <v-btn class="mt-4 mx-2" color="primary" flat @click="handleConfirm">
              <p class="text-white">{{ props.okButtonText }}</p>
            </v-btn>
            <v-btn class="mt-4 mx-2" color="grey" flat @click="handleCancel">{{ props.cancelButtonText }}</v-btn>
          </v-col>
        </v-row>
      </v-card-text>
    </v-card>
  </v-dialog>
</template>
