<template>
    <v-app-bar color="primary-darken-1">

        <template v-slot:prepend v-if="isAdmin">
            <v-app-bar-nav-icon color="white" @click="emit('toggleNavigationDrawer')"></v-app-bar-nav-icon>
        </template>

        <v-app-bar-title>Thunderous Knockout Fighting</v-app-bar-title>
        <v-spacer></v-spacer>

        <template v-if="isConnected">
            <v-btn @click="toggleAdmin" color="secondary" variant="flat">Toggle admin</v-btn>
            <template v-if="isAdmin">
                
            </template>

            <template v-else>
                <v-menu>
                    <template v-slot:activator="{ props }">
                        <v-btn
                            color="white"
                            dark
                            icon="mdi-dots-vertical"
                            v-bind="props"
                        >
                        </v-btn>
                    </template>

                    <v-list>
                        <v-list-item
                            v-for="item in userMenu" :key="item.value"
                            @click="router.push({ name: item.to })"
                            :value="item"
                            active-color="primary"
                        >
                            <template v-slot:prepend>
                                <v-icon :icon="item.icon"></v-icon>
                            </template>

                            <v-list-item-title>{{ item.value }}</v-list-item-title>
                        </v-list-item>
                    </v-list>
                </v-menu>
            </template>
        </template>

        <template v-else>
            <div class="d-flex mr-3" style="gap: 0.75rem;">
                <v-btn color="secondary" variant="flat">signup</v-btn>
                <v-btn color="white" variant="flat">signin</v-btn>
            </div>
        </template>
    </v-app-bar>
</template>
<script lang="ts">
import { storeToRefs } from 'pinia';
import { defineComponent } from 'vue';
import { useRouter } from 'vue-router';
import { useUserStore } from '../stores/user';

export default defineComponent({
    setup(props, { emit }) {
        const router = useRouter();

        const userStore = useUserStore();
        const { isConnected, isAdmin, user } = storeToRefs(userStore);
        const { toggleAdmin } = userStore;

        const userMenu = [
            {
                value: 'Account',
                icon: 'mdi-account',
                to: 'account'
            },
            {
                value: 'Wallet',
                icon: 'mdi-piggy-bank',
                to: 'wallet'
            }
        ]

        return { userMenu, router, isAdmin, isConnected, user, emit, toggleAdmin }
    }
})

</script>