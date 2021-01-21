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
                                {{ post.description }}
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
                    <div class="related-post-carousel">
                        <!--related post carousel-->
                        <div class="related-heading">
                            <h4>You might also like</h4>
                        </div>
                        <div class="items">
                            <div class="single-item" v-for="related in post.related">
                                <router-link :to="{name: 'show_post', params: {slug: related.slug}}" tag="button">
                                    <img v-if="related.image" :src="/uploads/ + related.image" alt="" style="height: 500px;">
                                    <img v-else src="/img/no-image.jpg" alt="" style="height: 500px;">
                                    <p>{{related.title}}</p>

                                </router-link>
                            </div>
                        </div>
                    </div>
                    <!--related post carousel-->
                    <div v-if="post.comments">
                        <div class="bottom-comment" v-for="comment in post.comments">
                            <!--bottom comment-->
                            <div class="comment-img">
                                <img class="img-circle" :src="comment.author.avatar ? comment.author.avatar : '/img/no-user-image.jpg'" alt=""
                                     width="75"
                                     height="75">
                            </div>
                            <div class="comment-text">
                                <h5>{{comment.author.name}}</h5>
                                <p class="comment-date">
                                    {{comment.created_at}}
                                </p>
                                <p class="para">{{comment.text}}</p>
                            </div>
                        </div>

                    </div>
                    <!-- end bottom comment-->

                    <div class="leave-comment" v-if="user">
                        <!--leave comment-->
                        <h4>Leave a reply</h4>


                            <div class="form-group">
                                <input type="hidden" name='post_id'>
                                <div class="col-md-12">
                                    <textarea class="form-control" rows="6" name="message" placeholder="Write Massage"
                                              v-model="commentMessage"></textarea>
                                </div>
                            </div>
                            <button class="btn send-btn" @click="addComment">Post Comment</button>
                    </div>
                    <!--end leave comment-->
                </div>
                <Sidebar/>

            </div>
        </div>
    </div>
</template>

<script>
    import PostModal from "../../modals/PostModal";
    import Sidebar from "../sidebar"

    export default {
        name: "PostPage",
        components: {
            PostModal,
            Sidebar,
        },
        data() {
            return {
                post: null,
                showModal: false,
                user: this.$store.getters.getUser,
                commentMessage: null
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
                    console.log(this.post);
                    this.$store.commit('setPreloader', false);
                })
            },
            deletePost(slug) {
                console.log('Delete post ' + slug)
            },
            saveChanges(post){

            },
            addComment(){

            },
        },
    }
</script>

<style scoped>

</style>
