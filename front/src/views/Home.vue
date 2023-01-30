<script lang="ts">
import { defineComponent } from 'vue';
import { useUserStore } from '../stores/user';
import { storeToRefs } from 'pinia';
import AdminView from '@/views/admin/AdminView.vue';

export default defineComponent({
    components: { AdminView },
    setup() {        
        const userStore = useUserStore();
        const { isAdmin } = storeToRefs(userStore);

        return { isAdmin }
    },
});
</script>

<template>
    <v-container>
        <admin-view v-if="isAdmin"></admin-view>
    </v-container>
</template>
