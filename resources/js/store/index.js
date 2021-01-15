import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from "vuex-persistedstate";
import Cookies from "js-cookie";

//Modules
import auth from './auth'
import user from './user'

Vue.use(Vuex);

createPersistedState({ storage: window.sessionStorage });

export default new Vuex.Store({
    modules:{
        auth,
        user,
    },
    plugins: [
        createPersistedState({
            storage: {
                getItem: (key) => Cookies.get(key),
                setItem: (key, value) => Cookies.set(key, value, { expires: 3 }),
                removeItem: (key) => Cookies.remove(key),
            },
            paths: ['auth']
        }),
    ],
})
