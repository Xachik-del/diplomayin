import Vue from 'vue';
import VueRouter from "vue-router";

import store from '../store'


import Register from '../components/auth/register'
import Login from '../components/auth/login'
import Home from '../components/pages/home'
import UserPosts from '../components/pages/posts/UserPosts'


Vue.use(VueRouter);


const routes = [
    {
        name: 'register',
        path: '/register',
        component: Register,
        meta: {
            auth: 'guest'
        }
    },
    {
        name: 'login',
        path: '/login',
        component: Login,
        meta: {
            auth: 'guest'
        }
    },
    {
        name: 'home',
        path: '/home',
        component: Home,
        meta: {
            auth: 'auth'
        }
    },
    {
        name: 'user_posts',
        path: '/my-posts',
        component: UserPosts,
        meta: {
            auth: 'auth'
        }
    },
];

const router = new VueRouter({
    routes,
    mode: 'hash'
});

router.beforeEach(async (to, from, next) => {
    // Hide mob menu

    let user = null;
    let clearStorage = () => {
        store.commit("setLoggedIn", false);
        store.commit("setUser", null);
        next('/login');
    };

    if (store.getters.isLoggedIn) {
        await axios.get("/current").then(({data}) => {

            if (data.user) {
                user = data.user;
                store.commit('setUser', user);
            } else {
                clearStorage();
            }
        }).catch(() => {
            clearStorage();
        });
    }

    if (to.meta.auth === 'guest') {
        if (user) {
            next('/home')
        } else {
            next();
        }
    } else {
        if (user) {
            next();
        } else {
            next('/login');
        }
    }

});

export default router
