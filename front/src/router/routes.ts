import Home from "../views/Home.vue"
import Bet from "../views/Bet.vue"
import Fighter from "../views/Fighter.vue"
import Sponsorship from "../views/Sponsorship.vue"
import Event from "../views/Event.vue"
import Login from "../views/Login.vue"
import Signup from "../views/Signup.vue"
import ResetPassword from "../views/ResetPassword.vue"
import Deposit from "../views/Deposit.vue"

export default [
    {
        path: '/',
        component: Home,
        name: 'home',
        meta: { requiresAuth: false, requiresAdmin: false }
    },
    {
        path: '/fighters',
        component: Fighter,
        name: 'fighter',
        meta: { requiresAuth: true, requiresAdmin: true }
    },
    {
        path: '/events',
        component: Event,
        name: 'event',
        meta: { requiresAuth: true, requiresAdmin: true }
    },
    {
        path: '/sponsorship',
        component: Sponsorship,
        name: 'sponsorship',
        meta: { requiresAuth: true, requiresAdmin: true }
    },
    {
        path: '/bet',
        component: Bet,
        name: 'bet',
        meta: { requiresAuth: true, requiresAdmin: false }
    },
    {
        path: '/login',
        component: Login,
        name: 'login',
        meta: { requiresAuth: false, requiresAdmin: false }
    },
    {
        path: '/signup',
        component: Signup,
        name: 'signup',
        meta: { requiresAuth: false, requiresAdmin: false }
    },
    {
        path: '/resetpassword',
        component: ResetPassword,
        name: 'resetpassword',
        meta: { requiresAuth: false, requiresAdmin: false }
    },
    {
        path: '/deposit',
        component: Deposit,
        name: 'deposit',
        meta: { requiresAuth: true, requiresAdmin: false }
    },
]