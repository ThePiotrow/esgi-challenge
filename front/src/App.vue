<script lang="ts">
import { storeToRefs } from 'pinia';
import { defineComponent, ref, onMounted } from 'vue';
import Header from './components/Header.vue';
import NavigationDrawer from './components/NavigationDrawer.vue';
import { useUserStore } from './stores/user';
import { token } from './service';
export default defineComponent({
    components: { Header, NavigationDrawer },
    setup() {
        const display = ref<boolean>(false);
        
        const userStore = useUserStore();
        const { signinWithToken } = userStore;
        const { isAdmin } = storeToRefs(userStore);

        onMounted(async () => {
            if (token.value) {
                try {
                    // TODO: Uncomment when the back function is ready
                    // await signinWithToken(token.value);
                } catch (error) {
                    
                }
            }
        })

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
