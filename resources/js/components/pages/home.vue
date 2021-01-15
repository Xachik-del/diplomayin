<template>
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">

                    <article class="post">
                        <div class="post-thumb">
<!--                            <a href="{{route('show',$post->slug)}}"><img src="{{$post->getImage()}}" alt="" style="height: 500px;"></a>-->


<!--                            <a href="{{route('show',$post->slug)}}" class="post-thumb-overlay text-center">-->
                                <div class="text-uppercase text-center">View Post</div>
<!--                            </a>-->
                        </div>
                        <div class="post-content">
                            <header class="entry-header text-center text-uppercase">
<!--                                @if($post->hasCategory())-->
<!--                                <h6><a href="{{route('category.show',$post->category->slug)}}"> {{$post->getCategoryTitle()}}</a></h6>-->
<!--                                @endif-->
<!--                                <h1 class="entry-title"><a href="{{route('show',$post->slug)}}">{{$post->title}}</a></h1>-->


                            </header>
                            <div class="entry-content">
<!--                                {!!$post->description!!}-->

                                <div class="btn-continue-reading text-center text-uppercase">
<!--                                    <a href="{{route('show',$post->slug)}}" class="more-link">Continue Reading</a>-->
                                </div>
                            </div>
                            <div class="social-share">
<!--                                <span class="social-share-title pull-left text-capitalize">By <a href="{{route('user.page',$post->author->id)}}">{{$post->author->name}}</a> {{$post->date}}</span>-->
                                <ul class="text-center pull-right">
                                    <li><a class="s-facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a class="s-twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a class="s-google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a class="s-linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a class="s-instagram" href="#"><i class="fa fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
<!--                        @if(Auth::user()->id == $post->user_id)-->
<!--                        <button class="btn btn-primary"><a href="{{route('post_remove',$post->id)}}" onclick="return confirm('Are You Sure?')" style="color:white;text-decoration:none;">Delete</a></button>-->
<!--                        @endif-->
                    </article>
<!--                    @endif-->
<!--                    @endforeach-->
<!--                    {{$posts->links()}}-->
                </div>
<!--                @include('pages._sidebar',['posts'=>$posts,'popularPosts'=>$popularPosts,'featuredPosts'=>$featuredPosts,'recentPosts'=>$recentPosts,'categories'=>$categories])-->
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "home",
        components:{},
        data() {
            return{

            }
        },
        methods: {}
    }
</script>

<style scoped>

</style>
