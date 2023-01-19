import { createRouter, createWebHistory } from "vue-router"
import routes from './routes';
import { useUserStore } from "../stores/user";
import { storeToRefs } from "pinia";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes
});

// router.beforeEach((to, from, next) => {
//     // const userStore = useUserStore();
//     // const { isAdmin, isConnected } = storeToRefs(userStore);

//     // console.log('config', to.meta.requiresAdmin, isAdmin.value)
//     // console.log(to.meta.requiresAuth && isConnected.value && !to.meta.requiresAdmin)
//     console.log('hey les man')
//     if (to.meta.requiresAdmin && to.meta.requiresAuth) {
//         // console.log('requiresAdmin', isAdmin)
//         next();
//     } else if (to.meta.requiresAuth && !to.meta.requiresAdmin) {
//         next();
//     } else {
//         console.log('else')
//         next({ name: 'login' });
//     }
// })

export default router;