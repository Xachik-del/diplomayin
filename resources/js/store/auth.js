export default {
    state:{
        access_token: null,
        expires_at: null,
        logged_in: false,
    },
    mutations:{
        setLoggedIn(state, payload){
            state.logged_in = payload;
        },
    },
    getters:{
        isLoggedIn(state){
            return state.logged_in;
        },
    },
}
