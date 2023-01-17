import Home from "../components/Home.vue"
import Login from "../view/Login.vue"

export default [
    {
        path: '/',
        component: Home,
        name: 'home'
    },
    {
        path: '/login',
        component: Login,
        name: 'login'
    }
]