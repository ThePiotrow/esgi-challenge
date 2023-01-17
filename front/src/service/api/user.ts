import { signinInterface, signupInterface } from "../../interfaces/payload";
import { client } from "../index";
import { clientWithoutAuth } from "../index";

class User {

  async _signin(payload: signinInterface): Promise<any> {
    try {
        const uri = '/signin'
        const res = await clientWithoutAuth.post(uri, payload);
        return res.data;
    } catch (error) {
        throw error;
    }
  } 

  async _signinWithToken(token: string): Promise<any> {
      try {
          const uri = '/tokenSignin'
          const res = await clientWithoutAuth.post(uri, { token: token });
          return res.data;
      } catch (error) {
          throw error;
      }
  } 

  async _signup(payload: signupInterface): Promise<any> {
      try {
          const uri = '/signup'
          const res = await clientWithoutAuth.post(uri, payload);
          return res.data;
      } catch (error) {
          throw error;
      }
  } 

  async _getUser(): Promise<any> {
      try {
          const uri = '/users/me'
          const res = await client.get(uri);
          return res.data;
      } catch (error) {
          throw error;
      }
  }
}

const userService = new User();

export default userService;