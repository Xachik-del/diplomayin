export default {
    state:{
        preloader: false,
        base_path: process.env.MIX_APP_URL,
    },
    mutations:{
        setPreloader(state, payload){
            state.preloader = payload;
        },
    },
    getters:{
        getPreloader(state){
            return state.preloader;
        },
        getBasePath(state){
            return state.base_path;
        },
    },
}
