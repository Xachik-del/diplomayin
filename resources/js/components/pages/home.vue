<template>
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">

                    <article class="post" v-for="post in posts.data">
                        <div class="post-thumb">
                            <router-link :to="{name: 'show_post', params: {slug: post.slug}}">
                                <img v-if="post.image" :src="/uploads/ + post.image" alt="" style="height: 500px;">
                                <img v-else src="/img/no-image.jpg" alt="" style="height: 500px;">
                            </router-link>


                            <router-link :to="{name: 'show_post', params: {slug: post.slug}}" class="post-thumb-overlay text-center">
                                <div class="text-uppercase text-center">View Post</div>
                            </router-link>
                        </div>
                        <div class="post-content">
                            <header class="entry-header text-center text-uppercase">

                                <h6 v-if="post.category">
                                    <router-link :to="{ name: 'show_category', params:{ category_slug: post.category.slug }}">
                                        {{post.category.title}}
                                    </router-link>
                                </h6>

                                <h1 class="entry-title">
                                    <router-link :to="{name: 'show_post', params: {slug: post.slug}}">{{ post.title }}</router-link>
                                </h1>
                            </header>
                            <div class="entry-content">
                                {{ post.description }}

                                <div class="btn-continue-reading text-center text-uppercase">
                                    <router-link :to="{name: 'show_post', params: {slug: post.slug}}" class="more-link">Continue Reading</router-link>
                                </div>
                            </div>
                            <div class="social-share">
                                <span class="social-share-title pull-left text-capitalize">By
                                    <router-link :to="{name: 'user_page', params: {user_id: post.author.id}}" tag="a">
                                        {{ post.author.full_name }}
                                    </router-link>
                                    At`
                                    {{  post.published_at }}
                                </span>
                                <ul class="text-center pull-right">
                                    <li><a class="s-facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a class="s-twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a class="s-google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a class="s-linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a class="s-instagram" href="#"><i class="fa fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <button class="btn btn-primary" v-if="post.user_id === user.id" @click="deletePost(post.slug)">Delete</button>
                    </article>

                    <Pagination :data="posts" @pagination-change-page="getPosts">
                        <span slot="prev-nav">&lt; Previous</span>
                        <span slot="next-nav">Next &gt;</span>
                    </Pagination>
                </div>
                <Sidebar/>
            </div>
        </div>
    </div>
</template>

<script>
    import Sidebar from './sidebar'
    import Pagination from 'laravel-vue-pagination'

    export default {
        name: "home",
        components: {Pagination, Sidebar},
        data() {
            return {
                posts: {},
                user: this.$store.getters.getUser,
            }
        },
        mounted() {
            this.getPosts();
        },
        methods: {
            getPosts(page = 1) {
                this.$store.commit('setPreloader', true);
                axios.get('api/posts?page=' + page).then(({data}) => {
                    if (data.success) {
                        this.posts = data.posts;
                    }
                    this.$store.commit('setPreloader', false);
                }).catch()
            },
            deletePost(slug) {
                console.log(slug);
            }
        }
    }
</script>

<style scoped>

</style>
