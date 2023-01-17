import { defineStore } from 'pinia'
import { user } from '../service/api';
import { signinInterface, signupInterface } from '../interfaces/payload';

export const useUserStore = defineStore('user', () => {

    const { _signin, _signup } = user;

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
    return { signin }
});