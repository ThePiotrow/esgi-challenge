import { defineStore } from 'pinia'
import { computed, reactive } from 'vue'
import { userService } from '../service/api';
import type { SigninI, SignupI } from '../interfaces/payload';
import { userInterface } from '../interfaces/responseAPI';
import { token } from '../service';

export const useUserStore = defineStore('user', () => {

    const { _signin, _signup, _getSelfUser, _getUsers, _signinWithToken } = userService;

    const user = reactive<userInterface>({
        id: '',
        email: 'antoine@gmail.com',
        username: 'antoine',
        roles: ['ROLE_ADMIN']
    })

    const isAdmin = computed(() => {
        return user.roles.includes('ROLE_ADMIN');
    });

    const isConnected = computed(() => {
        return !!user.email;
    });

    async function toggleAdmin() {
        if (user.roles.includes('ROLE_ADMIN')) {
            user.roles = ['ROLE_USER']
        } else {
            user.roles = ['ROLE_ADMIN']
        }
    }

    async function signin(payload: SigninI) {
        try {
            const res = await _signin(payload);
            token.value = res.token;
            const user = await _getSelfUser();
            console.log(user)
        } catch (e) {

        }
    }

    async function signup(payload: SignupI) {
        try {
            const res = await _signup(payload);
        } catch (e) {

        }
    }
    return { signin, signup, isAdmin, isConnected, user, toggleAdmin }
});