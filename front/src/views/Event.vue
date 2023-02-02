<template>
    <v-container>
      <Event></Event>
    </v-container>
  </template>
  <script lang="ts">
  import { defineComponent } from 'vue';
  import Event from "../components/Event.vue";
  export default defineComponent({
    components: { Event }
  });
  </script>