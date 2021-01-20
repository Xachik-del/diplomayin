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

                    <router-link :to="{name: 'post_page', params: {post_slug: post.slug}}" class="popular-img">
                        <img v-if="post.image" :src="/uploads/ + post.image" alt="" style="height: 500px;">
                        <img v-else src="/img/no-image.jpg" alt="" style="height: 500px;">
                        <div class="p-overlay"></div>
                    </router-link>

                    <div class="p-content">
                        <router-link :to="{name: 'post_page', params: {post_slug: post.slug}}" class="text-uppercase">
                            {{post.title}}
                        </router-link>
                        <span class="p-date">{{post.published_at}}</span>
                    </div>
                </div>
            </aside>

            <aside class="widget pos-padding">
                <h3 class="widget-title text-uppercase text-center">Recent Posts</h3>
                <div v-if="recent_posts" class="thumb-latest-posts" v-for="post in recent_posts" :key="post.id">
                    <div class="media">
                        <div class="media-center">
                            <router-link :to="{name: 'post_page', params: {post_slug: post.slug}}" class="popular-img">
                                <img v-if="post.image" :src="/uploads/ + post.image" alt="" style="height: 500px;">
                                <img v-else src="/img/no-image.jpg" alt="" style="height: 500px;">
                                <div class="p-overlay"></div>
                            </router-link>
                        </div>
                        <div class="p-content">
                            <router-link :to="{name: 'post_page', params: {post_slug: post.slug}}" class="text-uppercase">
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
                        <router-link :to="{name: category_posts, params: {category_slug: category.slug}}">
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
    export default {
        name: "sidebar",
        data() {
            return {
                recent_posts: null,
                popular_posts: null,
                categories: null,
            }
        },
        mounted() {
            this.getRecentPosts();
            this.getPopularPosts();
            this.getCategories();
        },
        methods: {
            getRecentPosts() {

            },
            getPopularPosts() {

            },
            getCategories() {

            }
        },
    }
</script>

<style scoped>

</style>
