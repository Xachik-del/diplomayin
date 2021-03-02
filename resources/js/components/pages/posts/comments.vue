<template>
    <div>
        <div class="bottom-comment" v-for="comment in comments">
            <!--bottom comment-->
            <div class="comment-img">
                <img class="img-circle" :src="comment.author.avatar ? comment.author.avatar : '/img/no-user-image.jpg'" alt=""
                     width="75"
                     height="75">
            </div>
            <div class="comment-text">
                <h5>{{comment.author.full_name}}</h5>
                <p class="comment-date">
                    {{comment.created_at}}
                </p>
                <p class="para">{{comment.text}}</p>
            </div>
        </div>

    </div>
</template>

<script>
    import {mapGetters} from 'vuex'

    export default {
        name: "Comments",
        mounted() {
            this.$store.dispatch('getComments');

            //use your own credentials you get from Pusher
            let pusher = new Pusher(process.env.MIX_PUSHER_APP_KEY, {
                cluster: process.env.MIX_PUSHER_APP_CLUSTER,
                encrypted: false
            });

            //Subscribe to the channel we specified in our Adonis Application
            let channel = pusher.subscribe('comment-channel');

            channel.bind('new-comment', (data) => {
                this.$store.commit('addComment', data.comment)
            })
        },
        computed: {
            ...mapGetters([
                'comments'
            ])
        }
    }
</script>

<style scoped>

</style>
