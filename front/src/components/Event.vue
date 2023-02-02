<template>
  <div class="flex flex-column gap-4">
    <div 
      v-for="event of eventsMock" 
      :key="event.id" 
      @click="router.push({ name: 'event-details', params: { id: event.id }})"
      class="cursor-pointer"
      >
      <v-card class="grid grid-cols-5">
        <div class="col-span-1 pa-5">{{ event.endTimestamp }}</div>
        <div class="col-span-1">
          <v-img :src="event.image" />
        </div>
        <div class="col-span-3 pa-5 flex flex-column">
          <p class="text-lg">{{ event.name }}</p>
          <p><span class="italic">{{ event.description }}</span> @{{ event.location }}</p>
          <div class="mt-auto">
            <div class="flex align-center gap-2">
              <v-icon icon="mdi-account-multiple"></v-icon>
              <p class="text-primary text-lg font-bold">{{ event.capacity }}</p>
            </div>
          </div>
        </div>
      </v-card>
    </div>
  </div>
</template>
<script lang="ts">
import { defineComponent, onMounted, ref  } from 'vue';
import { storeToRefs } from 'pinia';
import { useEventStore } from '../stores/event';
import eventsMock from '../mocks/events.json';
import { useRouter } from 'vue-router';

export default defineComponent({
  setup() {
    const router = useRouter();

    const eventStore = useEventStore();
    const { getEvents } = eventStore;
    const { events } = storeToRefs(eventStore);

    onMounted(async () => {
        try {
            await getEvents();
        } catch (error) {
            
        }
    });

    return { eventsMock, router }
  }
});
</script>