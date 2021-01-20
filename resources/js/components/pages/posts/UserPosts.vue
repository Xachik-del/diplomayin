<template>
    <!--main content start-->
    <div class="main-content">
        <div class="container">
            <div>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" @click="showModal = true">
                    Add Post
                </button>

                <post-modal v-if="showModal" :post="null" action="create" @close="showModal = false"></post-modal>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <article class="post" v-for="post in posts.data" :key="post.id">
                        {{post.title}}
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

                        <center>
                            <button class="btn btn-primary" @click="deletePost(post.slug)">Delete</button>
                        </center>

                    </article>

                    <Pagintaion :data="posts" @pagination-change-page="getUserPosts">
                        <span slot="prev-nav">&lt; Previous</span>
                        <span slot="next-nav">Next &gt;</span>
                    </Pagintaion>
                </div>
                <sidebar></sidebar>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment'
    import Pagintaion from "laravel-vue-pagination";
    import PostModal from "../../modals/PostModal";
    import Sidebar from "../sidebar"

    export default {
        name: "UserPosts",
        components: {
            Pagintaion,
            PostModal,
            Sidebar,
        },
        data() {
            return {
                posts: {},
                showModal: false,
            }
        },
        mounted() {
            this.getUserPosts();
        },
        methods: {
            getUserPosts(page = 1) {
                this.$store.commit('setPreloader', true);
                axios.get('/user-posts?page=' + page).then(({data}) => {
                    if (data.success){
                        this.posts = data.posts;
                        this.$store.commit('setPreloader', false);
                    }
                });
            },
            deletePost(slug) {
                console.log(slug);
            },
        }
    }
</script>

<style scoped>

</style>
