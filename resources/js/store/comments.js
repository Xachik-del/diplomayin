export default {
    state:{
        comments: [],
    },
    mutations:{
        getComments(state, payload){
            state.comments = payload;
        },
        addComment(state, payload) {
            state.comments = [...state.comments, payload]
        }
    },
    actions: {
        addComment({commit}, comment) {

            return new Promise((resolve, reject) => {
                axios.post('http://diplomayin.local/api/comments', comment)
                    .then(response => {
                        resolve(response)
                    }).catch(err => {
                    reject(err)
                })
            })
        },
        getComments({commit}) {
            axios.get('http://diplomayin.local/api/comments')
                .then(res => {
                    {
                        commit('getComments', res.data)
                    }
                })
                .catch(err => {
                    console.log(err)
                })
        }
    },
    getters:{
        comments(state){
            return state.comments;
        },
    },
}
