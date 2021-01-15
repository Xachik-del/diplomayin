<template>
    <div class="col-md-4 float-right" >
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
<!--                @foreach($popularPosts as $post)-->
<!--                <div class="popular-post">-->
<!--                    @if($post->status == 1)-->

<!--                    <a href="{{route('show',$post->slug)}}" class="popular-img"><img src="{{$post->getImage()}}" alt="" width="250px" height="250px">-->

<!--                        <div class="p-overlay"></div>-->
<!--                    </a>-->

<!--                    <div class="p-content">-->
<!--                        <a href="{{route('show',$post->slug)}}" class="text-uppercase">{{$post->title}}</a>-->
<!--                        <span class="p-date">{{$post->date}}</span>-->

<!--                    </div>-->
<!--                </div>-->
<!--                @endif-->
<!--                @endforeach-->
            </aside>

            <aside class="widget pos-padding">
                <h3 class="widget-title text-uppercase text-center">Recent Posts</h3>
<!--                @foreach($recentPosts as $post)-->
<!--                @if($post->status == 1)-->
<!--                <div class="thumb-latest-posts">-->
<!--                    <div class="media">-->
<!--                        <div class="media-center">-->
<!--                            <a href="{{route('show',$post->slug)}}" class="popular-img">-->
<!--                                <img src="{{$post->getImage()}}" alt="" height="250px">-->
<!--                                <div class="p-overlay"></div>-->
<!--                            </a>-->
<!--                        </div>-->
<!--                        <div class="p-content">-->
<!--                            <a href="{{route('show',$post->slug)}}" class="text-uppercase">{{$post->title}}</a>-->
<!--                            <span class="p-date">{{$post->date}}</span>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                @endif-->
<!--                @endforeach-->
            </aside>
            <aside class="widget border pos-padding">
                <h3 class="widget-title text-uppercase text-center">Categories</h3>
                <ul>
<!--                    @foreach($categories as $category)-->
<!--                    <li>-->
<!--                        <a href="{{route('category.show',$category->slug)}}">{{$category->title}}</a>-->
<!--                        <span class="post-count pull-right"> ({{$category->posts()->count()}})</span>-->
<!--                    </li>-->
<!--                    @endforeach-->
                </ul>
            </aside>

        </div>
    </div>

</template>

<script>
    export default {
        name: "sidebar"
    }
</script>

<style scoped>

</style>
