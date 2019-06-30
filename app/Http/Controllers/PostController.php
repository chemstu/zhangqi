<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function  index(){
        $tags=Tag::all();
        $categories=Category::all();
        $posts=Post::with('category','tags')->get();
        return view('index',compact('tags','categories','posts'));
    }

    public function  post(Post $post){
        $tags=Tag::all();
        $categories=Category::all();
        return view('post',compact('post','tags','categories'));
    }


    public function  category(Category $category){
        $tags=Tag::all();
        $categories=Category::all();
        $posts=$category->posts;

        return view('index',compact('posts','tags','categories'));
    }

    public function  tag(Tag $tag){
        $tags=Tag::all();
        $categories=Category::all();
        $posts=$tag->posts();
        return view('index',compact('posts','tags','categories'));
    }

    public function contact(){
        return view('contact');
    }
}
