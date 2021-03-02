<template>
    <div class="col-md-4 float-right">
        <div class="primary-sidebar">

            <aside class="widget news-letter">
                <h3 class="widget-title text-uppercase text-center">Get Newsletter</h3>

                <!--                @include('admin.errors')-->
                <form action="/subscribe" method="post">
                    <!--                    {{csrf_field()}}-->
                    <input type="email" placeholder="Your email address" name='email'>
                    <input type="submit" value="Subscribe Now" class="text-uppercase text-center btn btn-subscribe">
                </form>

            </aside>
            <aside class="widget">
                <h3 class="widget-title text-uppercase text-center">Popular Posts</h3>
                <div v-if="popular_posts" class="popular-post" v-for="post in popular_posts" :key="post.id">

                    <router-link :to="{name: 'show_post', params: {slug: post.slug}}" class="popular-img">
                        <img v-if="post.image" :src="/uploads/ + post.image" alt="" style="height: 250px;">
                        <img v-else src="/img/no-image.jpg" alt="" style="height: 250px;">
                        <div class="p-overlay"></div>
                    </router-link>

                    <div class="p-content">
                        <router-link :to="{name: 'show_post', params: {slug: post.slug}}" class="text-uppercase">
                            {{post.title}}
                        </router-link>
                        <span class="p-date">{{post.published_at}}</span>
                    </div>
                </div>
            </aside>
            <aside class="widget">
                <h3 class="widget-title text-uppercase text-center">Featured Posts</h3>
                <div v-if="featured_posts">
                    <carousel :autoplay=true :autoplayTimeout=3500 :perPage=1 :speed=500 easing="linear" :paginationEnabled="false">
                        <slide v-for="post in featured_posts" :key="post.id">
                            <img v-if="post.image" :src="/uploads/ + post.image" alt="" class="card-img-top">
                            <img v-else src="/img/no-image.jpg" alt="" class="card-img-top">
                            <div class="card-img-overlay">
                                <router-link :to="{name: 'show_post', params: {slug: post.slug}}" tag="a">
                                    <h5 align="center" class="text-uppercase card-title">{{post.title}}</h5>
                                    <p align="center" class="card-text">{{post.content}}</p>
                                </router-link>
                            </div>
                        </slide>
                    </carousel>
                </div>
            </aside>
<!--            <aside class="widget">-->


<!--                <div v-if="featured_posts">-->
<!--                        <carousel :autoplay=true :autoplayTimeout=3500 :perPage=1 :speed=500 easing="linear" :paginationEnabled="false">-->
<!--                            <slide v-for="post in featured_posts" :key="post.id">-->
<!--                                <router-link :to="{name: 'show_post', params: {slug: post.slug}}" tag="a" style="text-decoration: none">-->
<!--                                    <img v-if="post.image" :src="/uploads/ + post.image" alt="">-->
<!--                                    <img v-else src="/img/no-image.jpg" alt="">-->
<!--                                    <h5 align="center" class="text-uppercase">{{post.title}}</h5>-->
<!--                                    <p align="center">{{post.content}}</p>-->
<!--                                </router-link>-->
<!--                            </slide>-->
<!--                        </carousel>-->
<!--                </div>-->
<!--            </aside>-->
            <aside class="widget pos-padding">
                <h3 class="widget-title text-uppercase text-center">Recent Posts</h3>
                <div v-if="recent_posts" class="thumb-latest-posts" v-for="post in recent_posts" :key="post.id">
                    <div class="media">
                        <div class="media-center">
                            <router-link :to="{name: 'show_post', params: {slug: post.slug}}" class="popular-img">
                                <img v-if="post.image" :src="/uploads/ + post.image" alt="" style="height: 250px;">
                                <img v-else src="/img/no-image.jpg" alt="" style="height: 250px;">
                                <div class="p-overlay"></div>
                            </router-link>
                        </div>
                        <div class="p-content">
                            <router-link :to="{name: 'show_post', params: {slug: post.slug}}" class="text-uppercase">
                                {{post.title}}
                            </router-link>
                            <span class="p-date">{{post.published_at}}</span>
                        </div>
                    </div>
                </div>

            </aside>
            <aside class="widget border pos-padding">
                <h3 class="widget-title text-uppercase text-center">Categories</h3>
                <ul>
                    <li v-if="categories" v-for="category in categories" :key="category.id">
                        <router-link :to="{name: 'show_category', params: {category_slug: category.slug}}">
                            {{category.title }}
                        </router-link>
                        <span class="post-count pull-right"> ({{ category.posts.length }})</span>
                    </li>
                </ul>
            </aside>

        </div>
    </div>

</template>

<script>
    import {Carousel, Slide} from 'vue-carousel';

    export default {
        name: "sidebar",
        components: {Carousel, Slide},
        data() {
            return {
                recent_posts: null,
                popular_posts: null,
                featured_posts: null,
                categories: null,
            }
        },
        mounted() {
            this.getRecentPosts();
            this.getPopularPosts();
            this.getFeaturedPosts();
            this.getCategories();
        },
        methods: {
            getRecentPosts() {
                this.$store.commit('setPreloader', true);
                axios.get(this.$store.getters.getBasePath + '/api/recent-posts').then(({data}) => {
                    if (data.success) {
                        this.recent_posts = data.recent_posts;
                        this.$store.commit('setPreloader', false);
                    }
                });
            },
            getPopularPosts() {
                this.$store.commit('setPreloader', true);
                axios.get(this.$store.getters.getBasePath + '/api/popular-posts').then(({data}) => {
                    if (data.success) {
                        this.popular_posts = data.popular_posts;
                        this.$store.commit('setPreloader', false);
                    }
                });
            },
            getFeaturedPosts() {
                this.$store.commit('setPreloader', true);
                axios.get(this.$store.getters.getBasePath + '/api/featured-posts').then(({data}) => {
                    if (data.success) {
                        this.featured_posts = data.featured_posts;
                        this.$store.commit('setPreloader', false);
                    }
                });
            },
            getCategories() {
                this.$store.commit('setPreloader', true);
                axios.get(this.$store.getters.getBasePath + '/api/categories').then(({data}) => {
                    if (data.success) {
                        this.categories = data.categories;
                        this.$store.commit('setPreloader', false);
                    }
                });
            }
        },
    }
</script>

<style scoped>

</style>
