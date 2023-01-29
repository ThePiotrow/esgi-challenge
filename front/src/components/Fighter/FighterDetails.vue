<template>
   <div>{{  fighter }}</div>
</template>
  
<script lang="ts">
import { storeToRefs } from 'pinia';
import { defineComponent, computed, onMounted, ComputedRef } from 'vue';
import { useRoute } from "vue-router";
import { useFighterStore } from '@/stores/fighter';
import { createToast } from 'mosha-vue-toastify';
export default defineComponent({
  setup() {
      const route = useRoute();
      const fighterStore = useFighterStore();

      const { getFighter } =  fighterStore;
      const { fighter } =  storeToRefs(fighterStore);

      const  fighterId= computed(() => route.params.id);

      onMounted(async () => {
        try {
          await getFighter(fighterId.value);
        } catch (error) {
          createToast('Error while fetching fighter', { position: 'bottom-right', type: 'danger' })
        }
      })

      return { fighterId, fighter }
    }
});
  </script>