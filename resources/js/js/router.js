import { createRouter, createWebHistory } from 'vue-router';
import { defineAsyncComponent } from 'vue';
import UserAuth from './pages/auth/UserAuth.vue';
import NotFound from './pages/NotFound.vue';

const router = createRouter({
    history : createWebHistory(),
    routes : [
        {path : '/' },
        { path: '/auth', component: UserAuth },
        { path: '/:notFound(.*)', component: NotFound }
    ]
});


export default router;
