<template>
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8" v-if="post">

                    <article class="post" v-if="post">
                        <div class="post-thumb">
                            <img v-if="post.image" :src="/uploads/ + post.image" alt="" style="height: 500px;">
                            <img v-else src="/img/no-image.jpg" alt="" style="height: 500px;">
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
                                {{ post.content }}
                            </div>
                            <!--                            <div class="decoration">-->
                            <!--                                <router-link v-for="tag in tags" :to="{name: 'tag_show', params: {tag_slug: tag.slug }}" class="btn btn-default"-->
                            <!--                                             :key="tag.id">-->
                            <!--                                    {{tag.title}}-->
                            <!--                                </router-link>-->
                            <!--                            </div>-->

                            <div class="social-share">
                                <span class="social-share-title pull-left text-capitalize">By
                                    <router-link :to="{name: 'user_page', params: {user_id: post.author.id}}" tag="a">
                                        {{ post.author.full_name }}
                                    </router-link>

                                    {{  post.is_published ?  post.published_at : ''  }}
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
                        <div v-if="post.user_id === user.id">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" @click="showModal = true">
                                Edit Post
                            </button>
                            <button class="btn btn-primary" @click="deletePost(post.slug)">Delete</button>

                            <post-modal v-if="showModal" :post="post" action="update" @close="saveChanges"></post-modal>
                        </div>
                    </article>
                    <div class="top-comment">
                        <!--top comment-->
                        <img :src="post.author.avatar ? post.author.avatar : '/img/no-user-image.jpg'" class="pull-left img-circle" alt=""
                             width="100" height="100">
                        <router-link :to="{name: 'user_page', params: {user_id: post.author.id}}" tag="a">
                            {{ post.author.full_name }}
                        </router-link>
                        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy hello ro mod tempor
                            invidunt ut labore et dolore magna aliquyam erat.</p>
                    </div>

                    <!--top comment end-->
                    <div class="row">
                        <!--blog next previous-->
                        <div class="col-md-6">

                            <div class="single-blog-box" v-if="post.previous">
                                <router-link :to="{name: 'show_post', params: {slug: post.previous.slug}}">
                                    <img v-if="post.previous.image" :src="/uploads/ + post.previous.image" alt="" style="height: 500px;">
                                    <img v-else src="/img/no-image.jpg" alt="" style="height: 500px;">
                                    <div class="overlay">

                                        <div class="promo-text">
                                            <p><i class=" pull-left fa fa-angle-left"></i></p>
                                            <h5> {{ post.previous.title }} </h5>
                                        </div>
                                    </div>
                                </router-link>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="single-blog-box" v-if="post.next">
                                <router-link :to="{name: 'show_post', params: {slug: post.next.slug}}">
                                    <img v-if="post.next.image" :src="/uploads/ + post.next.image" alt="" style="height: 500px;">
                                    <img v-else src="/img/no-image.jpg" alt="" style="height: 500px;">
                                    <div class="overlay">

                                        <div class="promo-text">
                                            <p><i class=" pull-left fa fa-angle-left"></i></p>
                                            <h5> {{ post.next.title }} </h5>
                                        </div>
                                    </div>
                                </router-link>
                            </div>
                        </div>
                    </div>
                    <!--blog next previous end-->
                    <div class="related-post-carousel" v-if="related_posts">
                        <!--related post carousel-->
                        <div class="related-heading">
                            <h4>You might also like</h4>
                        </div>
                        <carousel :autoplay=true :autoplayTimeout=3500 :perPage=2 :speed=500 easing="linear">
                            <slide v-for="post in related_posts" :key="post.id">
                                <router-link :to="{name: 'show_post', params: {slug: post.slug}}" tag="a">
                                    <img v-if="post.image" :src="/uploads/ + post.image" alt="">
                                    <img v-else src="/img/no-image.jpg" alt="">
                                    <p align="center">{{post.title}}</p>
                                </router-link>
                            </slide>
                        </carousel>
                    </div>
                    <!--related post carousel-->

                    <comments/>

                    <!-- end bottom comment-->

                    <div class="leave-comment" v-if="user">
                        <!--leave comment-->
                        <h4>Leave a reply</h4>


                        <div class="form-group">
                            <input type="hidden" name='post_id'>
                            <div class="col-md-12">
                                    <textarea class="form-control" rows="6" name="message" placeholder="Write Massage"
                                              v-model="comment.text" @keypress.enter="addComment(post.id)"></textarea>
                            </div>
                        </div>
                        <button class="btn send-btn" @click="addComment(post.id)">Post Comment</button>
                    </div>
                    <!--end leave comment-->
                </div>
                <Sidebar/>

            </div>
        </div>
    </div>
</template>

<script>
    import Comments from './comments'
    import PostModal from "../../modals/PostModal";
    import Sidebar from "../sidebar"
    import {Carousel, Slide} from 'vue-carousel';

    export default {
        name: "PostPage",
        components: {
            PostModal,
            Sidebar,
            Carousel,
            Slide,
            Comments
        },
        data() {
            return {
                post: null,
                showModal: false,
                user: this.$store.getters.getUser,
                comment : {
                  'text' : null,
                  'post_id' : null,
                },
                related_posts: null
            }
        },
        mounted() {
            this.getPost();
        },
        methods: {
            getPost() {
                this.$store.commit('setPreloader', true);
                axios.get('/api' + this.$route.fullPath).then(({data}) => {
                    this.post = data.post;
                    this.getRelatedPosts();
                    this.$store.commit('setPreloader', false);
                })
            },
            deletePost(slug) {
                let base_url = this.$store.getters.getBasePath;
                let that = this;
                alertify.confirm('Delete Post', 'Are Youe Sure?', function () {
                    axios.delete(base_url + '/api/posts/' + that.post.slug).then(({data}) => {
                        if (data.success) {
                            alertify.success(data.message, '5');
                            that.$router.push({name: 'user_posts', query: {page: '1'}})
                        } else {
                            alertify.error(data.message, '5');
                        }
                    })
                }, function () {
                    alertify.error('Cancel')
                });


            },
            saveChanges(post) {
                if (post) {
                    this.post = post;
                    this.$router.push({name: 'show_post', params: {slug: this.post.slug}})
                }
            },
            addComment(post_id) {
                this.comment.post_id = post_id;
                this.$store.dispatch('addComment', this.comment).then(({data}) => {
                    if (data.success) {
                        this.comment.text = null;
                        alertify.success("Comment successfully added", '5');
                    } else {
                        alertify.error(data.message, '5');
                    }
                });
            },
            getRelatedPosts() {
                axios.get(this.$store.getters.getBasePath + '/api/related-posts/' + this.post.slug).then(({data}) => {
                    this.related_posts = data.relatedPosts;
                });
            }
        },
        watch: {
            $route(to, from) {
                if (to.name === from.name && to.path !== from.path) {
                    this.getPost();
                }
            }
        }
    }
</script>

<style scoped>

</style>
