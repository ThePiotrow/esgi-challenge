import { SigninI, SignupI, TokenI, UserI } from "../../interfaces/payload";
import { client } from "../index";
import { clientWithoutAuth } from "../index";

class User {

    async _signin(payload: SigninI): Promise<TokenI> {
        try {
            const uri = '/authentication_token'
            const res = await clientWithoutAuth.post(uri, payload);
            return res.data;
        } catch (error) {
            throw error;
        }
    } 

    async _signinWithToken(token: string): Promise<TokenI> {
        try {
            const uri = '/tokenSignin'
            const res = await clientWithoutAuth.post(uri, { token: token });
            return res.data;
        } catch (error) {
            throw error;
        }
    } 

    async _signup(payload: SignupI): Promise<void> {
        try {
            const uri = '/users'
            const res = await clientWithoutAuth.post(uri, payload);
            return res.data;
        } catch (error) {
            throw error;
        }
    } 

    async _getUser(): Promise<UserI> {
        try {
            const uri = '/users/me'
            const res = await client.get(uri);
            return res.data;
        } catch (error) {
            throw error;
        }
    } 

  async _getUsers(): Promise<UserI> {
        try {
            const uri = '/users'
            const res = await client.get(uri);
            return res.data;
        } catch (error) {
            throw error;
        }
    } 
}

const userService = new User();

export default userService;