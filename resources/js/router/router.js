import Vue from 'vue';
import VueRouter from "vue-router";
import moment from 'moment';

import store from '../store'


import Register from '../components/auth/register'
import Login from '../components/auth/login'
import Home from '../components/pages/home'


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
            auth: 'user'
        }
    },
];

const router = new VueRouter({
    routes,
    mode: 'hash'
});

router.beforeEach(async(to, from, next) => {
    // Hide mob menu

    let user = null;
    let clearStorage = () => {
        store.commit("setLoggedIn", false);
        store.commit("setUser", null);
        next('/');
    };

    if (store.getters.isLoggedIn) {
        console.log(store.getters.isLoggedIn);
            await axios.get("/current").then(({ data }) => {
                if (data.success) {
                    user = data.user;
                    console.log(user);
                    store.commit('setUser', user);
                } else {
                    clearStorage();
                }
            }).catch(() => {
                clearStorage();
            });
    }
    next();

    // if (to.meta.auth === 'guest') {
    //     if (user) {
    //         next(configs[user.role.name].home)
    //     } else {
    //         next();
    //     }
    // } else {
    //     if (user) {
    //         if (to.meta.roles.indexOf(user.role.name) !== -1) {
    //             next();
    //         } else {
    //             next(configs[user.role.name].home)
    //         }
    //     } else {
    //         next('/enter');
    //     }
    // }

});

export default router
