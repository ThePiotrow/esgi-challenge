import Home from "../views/Home.vue"
import Bet from "../views/Bet.vue"
import Fighter from "../views/Fighter.vue"
import Sponsorship from "../views/Sponsorship.vue"
import Event from "../views/Event.vue"

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
    }
]