@extends('layouts.app')
@section('bg-img',asset('front/img/post-page.jpg'))
@section('page_header')
    <div id="post-header" class="page-header">
        <div class="background-img" style="background-image: url('@yield('bg-img')')"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <div class="post-meta">
                        <a class="post-category cat-2" href="{{route('category',$post->category['id'])}}">{{$post->category['name']}}</a>
                        <span class="post-date">{{$post->updated_at->toDateString()}}</span>
                    </div>
                    <h1>{{$post->title}}</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Header -->
    @endsection

@section('content')


    <div class="row">
        <!-- Post content -->
        <div class="col-md-12">
            <div class="section-row sticky-container">
                <div class="main-post">
                    <h3>内容概要</h3>
                    <blockquote class="blockquote">
                    {{$post->summary}}
                    </blockquote>
                    <div class="aside-widget">
                        <div class="tags-widget">
                            <ul>
                                关键词：
                                @foreach($post->tags as $tag)
                                    <li><a href="{{route('tag',$tag->id)}}">{{$tag->name}}</a></li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                    {!!htmlspecialchars_decode($post->body)!!}
                </div>
            </div>
            <!-- ad -->
            <div class="section-row text-center">
                <a href="#" style="display: inline-block;margin: auto;">
                    <img class="img-responsive" src="./img/ad-2.jpg" alt="">
                </a>
            </div>
            <!-- ad -->
            <!-- author -->
            <div class="section-row">
                <div class="post-author">
                    <div class="media">
                        <div class="media-left">
                            <img class="media-object" src="{{asset('front/img/author.png')}}" alt="">
                        </div>
                        <div class="media-body">
                            <div class="media-heading">
                                <h3>联系站长获取相关资源</h3>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                            <ul class="author-social">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /author -->


        </div>
        <!-- /Post content -->
   </div>

    @endsection