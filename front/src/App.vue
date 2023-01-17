<script lang="ts">
import { storeToRefs } from 'pinia';
import { defineComponent, ref } from 'vue';
import Header from './components/Header.vue';
import NavigationDrawer from './components/NavigationDrawer.vue';
import { useUserStore } from './stores/user';
export default defineComponent({
    components: { Header, NavigationDrawer },
    setup() {
        const display = ref<boolean>(false);
        
        const userStore = useUserStore();
        const { isAdmin } = storeToRefs(userStore);

        return { display, isAdmin }
    },
});
</script>

<template>
    <v-app app>
        <Header @toggleNavigationDrawer="display = !display"></Header>
        <NavigationDrawer v-if="isAdmin" :display="display"></NavigationDrawer>
        <v-main>
            <router-view></router-view>
        </v-main>
    </v-app>
</template>
