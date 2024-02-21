<template>
  <v-menu activator="parent" location="start">
    <v-list>
      <v-list-item v-for="(item, index) in menuItems" :key="index" :value="index" @click="handleItemClick(item)">
        <v-list-item-title :style="item.style">
          {{ item.title }}
        </v-list-item-title>
      </v-list-item>
    </v-list>
  </v-menu>
</template>

<script setup>
  import { defineProps } from "vue";

  const props = defineProps({
    menuItems: Array,
    onMenuItemClick: Function
  });

  const handleItemClick = (item) => {
    props.onMenuItemClick(item);
  };
</script>
