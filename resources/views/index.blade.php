@extends('layouts.app')
@section('bg-img',asset('front/img/post-page.jpg'))
@section('content')
    <div class="row">
        <!-- post -->
        @foreach($posts as $post)
        <div class="col-md-12">
            <div class="post post-row">
                <a class="post-img" href="blog-post.html"><img src="https://cnhuaxue.oss-cn-hangzhou.aliyuncs.com/{{$post->image}}!270160" alt=""></a>
                <div class="post-body">
                    <div class="post-meta">
                        <a class="post-category {{$post->category->color}}" href="">{{$post->category->name}}</a>
                        <span class="post-date">{{$post->created_at->diffForHumans()}}</span>
                    </div>
                    <h3 class="post-title"><a href="{{route('post',$post->id)}}">{{$post->title}}</a></h3>
                    <p>{{$post->summary}}...</p>
                </div>
            </div>
        </div>
        @endforeach
        <!-- /post -->
        <div class="col-md-12">
            <div class="section-row">
                <button class="primary-button center-block">加载更多</button>
            </div>
        </div>
   </div>

    @endsection