import Home from "../views/Home.vue"
import Bet from "../views/Bet.vue"
import Fighter from "../views/Fighter.vue"
import Sponsorship from "../views/Sponsorship.vue"
import Event from "../views/Event.vue"
import Login from "../view/Login.vue"
import Signup from "../view/Signup.vue"
import ResetPassword from "../view/ResetPassword.vue"
import Deposit from "../view/Deposit.vue"

export default [
    {
        path: '/',
        component: Home,
        name: 'home'
    },
    {
        path: '/fighters',
        component: Fighter,
        name: 'fighter' 
    },
    {
        path: '/events',
        component: Event,
        name: 'event' 
    },
    {
        path: '/sponsorship',
        component: Sponsorship,
        name: 'sponsorship' 
    },
    {
        path: '/bet',
        component: Bet,
        name: 'bet' 
    },
    {
        path: '/login',
        component: Login,
        name: 'login'
    },
    {
        path: '/signup',
        component: Signup,
        name: 'signup'
    },
    {
        path: '/resetpassword',
        component: ResetPassword,
        name: 'resetpassword'
    },
    {
        path: '/deposit',
        component: Deposit,
        name: 'deposit'
    },
]