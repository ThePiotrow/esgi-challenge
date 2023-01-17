<template>
    <v-app-bar color="primary-darken-1">
        <template v-slot:prepend>
            <v-app-bar-nav-icon color="white"></v-app-bar-nav-icon>
        </template>
        <v-app-bar-title>Thunderous Knockout Fighting</v-app-bar-title>
        <v-spacer></v-spacer>
        <v-btn color="secondary" variant="flat">signup</v-btn>
        <v-btn color="white" variant="outlined">signin</v-btn>
        
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
    </v-app-bar>
</template>
<script lang="ts">
import { defineComponent } from 'vue';
import { useRouter } from 'vue-router';

export default defineComponent({
    setup() {
        const router = useRouter();

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

        return { userMenu, router }
    }
})

</script>
<style lang="">
    
</style>