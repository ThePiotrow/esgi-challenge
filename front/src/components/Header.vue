<template>
    <v-app-bar color="primary-darken-1 pr-6">

        <template v-slot:prepend v-if="isAdmin">
            <v-app-bar-nav-icon color="white" @click="emit('toggleNavigationDrawer')"></v-app-bar-nav-icon>
        </template>

        <v-app-bar-title>Thunderous Knockout Fighting</v-app-bar-title>
        <v-spacer></v-spacer>

        <template v-if="isConnected">
            
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

        <div v-else class="d-flex" style="gap: 0.75rem;">
            <v-btn color="secondary" variant="flat">signup</v-btn>
            <v-btn color="white" variant="outlined">signin</v-btn>
        </div>
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

        return { userMenu, router, isAdmin, isConnected, user, emit }
    }
})

</script>
<style lang="">
    
</style>