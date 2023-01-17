<template>
  <div>
    <Fighter></Fighter>
  </div>
</template>
<script lang="ts">
import { defineComponent } from 'vue';
import Fighter from '../components/Fighter.vue';
export default defineComponent({
  components: { Fighter }
});
</script>