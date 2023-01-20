import { defineStore } from 'pinia'
import { computed, ref } from 'vue'
import { userService } from '../service/api';
import type { SigninI, SignupI } from '../interfaces/payload';
import type { userInterface } from '../interfaces/responseAPI';
import { token } from '../service';
import { useRouter } from "vue-router"

export const useUserStore = defineStore('user', () => {
    const router = useRouter();

    const { _signin, _signup, _getSelfUser, _getUsers, _signinWithToken } = userService;

    const user = ref<userInterface>();

    const isAdmin = computed(() => {
        return user.value?.roles.includes('ROLE_ADMIN');
    });

    const isConnected = computed(() => {
        return !!user.value?.email;
    });

    async function toggleAdmin() {
        if (user.value) {
            if (user.value.roles.includes('ROLE_ADMIN')) {
                user.value.roles = ['ROLE_USER']
            } else {
                user.value.roles = ['ROLE_ADMIN']
            }
        }
    }

    async function signin(payload: SigninI) {
        try {
            const res = await _signin(payload);
            token.value = res.token;
            const self = await _getSelfUser();
            user.value = self;
        } catch (e) {

        }
    }

    async function signup(payload: SignupI) {
        try {
            const res = await _signup(payload);
        } catch (e) {

        }
    }

    async function logout() {
        try {
            user.value = undefined;
            router.push({ name: 'login' });
        } catch (e) {

        }
    }
    return { signin, signup, isAdmin, isConnected, user, toggleAdmin, logout }
});