import { createRouter, createWebHistory } from 'vue-router';
import { defineAsyncComponent } from 'vue';
import UserAuth from './pages/auth/UserAuth.vue';
import NotFound from './pages/NotFound.vue';
import Home from './pages/Home';
import store from './store/index';

const router = createRouter({
    history : createWebHistory(),
    routes : [
        {path : '/',redirect: '/home' },
        {path: '/home', component : Home,meta: { requiresAuth: true }},
        { path: '/auth', component: UserAuth,meta: { requiresUnauth: true } },
        { path: '/:notFound(.*)', component: NotFound }
    ]
});


router.beforeEach(function(to, _, next) {
    if (to.meta.requiresAuth && !store.getters.isAuthenticated) {
        next('/auth');
    } else if (to.meta.requiresUnauth && store.getters.isAuthenticated) {
        next('/home');
    } else {
        next();
    }
});


export default router;
