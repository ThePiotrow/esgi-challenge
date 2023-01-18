export interface signinInterface {
  email: string
  password: string
}

export interface signupInterface {
  username: string
  email: string
  password: string
  role: Array<string>
}

export interface fighterInterface {
  firstname: string
  lastname: string
  height: number
  weight: number
  nationality: string
  gender: string
  birthdate: string
}