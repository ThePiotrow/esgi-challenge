import { defineStore } from 'pinia'
import { computed, reactive, ref } from 'vue'
import { userService } from '../service/api';
import type { signinInterface, signupInterface } from '../interfaces/payload';
import { userInterface } from '../interfaces/responseAPI';

export const useUserStore = defineStore('user', () => {

    const { _signin, _signup } = userService;

    const user = reactive<userInterface>({
        id: '1',
        email: '',
        username: 'admin',
        roles: ['ROLE_USER']
    })

    const isAdmin = computed(() => {
        return user.roles.includes('ROLE_ADMIN') && user.roles.length !== 0;
    });

    const isConnected = computed(() => {
        return !!user.email;
    })

    async function signin(payload: signinInterface) {
        try {
            const res = await _signin(payload);
        } catch (e) {

        }
    }

    async function signup(payload: signupInterface) {
        try {
            const res = await _signup(payload);
        } catch (e) {

        }
    }
    return { signin, signup, isAdmin, isConnected, user }
});