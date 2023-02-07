<template>
    <v-container class="flex flex-col gap-4">
        <event v-if="isVIP" :events="VIPevents" :admin="isAdmin" />
        <event :events="filteredEvents" :admin="isAdmin" />
    </v-container>
</template>

<script lang="ts">
import { defineComponent, onMounted, computed  } from 'vue';
import { storeToRefs } from 'pinia';
import { useEventStore } from '../stores/event';
import eventsMock from '../mocks/events.json';
import { useRouter } from 'vue-router';
import Event from "../components/Event.vue";
import { useUserStore } from '@/stores/user';
export default defineComponent({
    components: { Event },
    setup() {
        const router = useRouter();
        const userStore = useUserStore();
        const { isVIP, isAdmin } = storeToRefs(userStore);
        const eventStore = useEventStore();
        const { getEvents } = eventStore;
        const { events } = storeToRefs(eventStore);

        onMounted(async () => {
            try {
                await getEvents();
            } catch (error) {
                
            }
        });

        const VIPevents = computed(() => {
        return eventsMock.filter(event => event.VIP === true);
        });

        const filteredEvents = computed(() => eventsMock.filter(event => event.VIP === false));

        return { eventsMock, router, VIPevents, filteredEvents, isVIP, isAdmin }
  }
});
</script>