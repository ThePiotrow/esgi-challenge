<script lang="ts">
import { defineComponent } from 'vue';
import Header from './components/Header.vue';
export default defineComponent({
    components: { Header },
    setup() {},
});
</script>

<template>
    <v-app app>
        <Header></Header>
        <v-main>
            <router-view></router-view>
        </v-main>
    </v-app>
</template>
