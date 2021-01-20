export default {
    state:{
        preloader: false,
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
    },
}
