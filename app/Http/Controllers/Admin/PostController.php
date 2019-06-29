<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Services\OSS;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::with('category')->paginate(30);
        return view('admin.post_index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        $tags=Tag::all();
        return view('admin.post_create',compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request,Post $post)
    {

        $post->fill($request->all());
        if ($request->hasFile('image')) {
            //带扩展名的文件名
            $filenamewithextension=$request->file('image')->getClientOriginalName();
            //不带扩展名的文件名
            $filename=pathinfo($filenamewithextension,PATHINFO_FILENAME);
            //文件扩展名
            $extention=$request->file('image')->getClientOriginalExtension();
            //新的文件名
            $file_name =  'post/' . time() . rand(10, 99) . '.' .$extention;
            //上传文件至oss
            //文件类型
            $content_type= mime_content_type($request->file('image')->getRealPath());
            $content = file_get_contents($request->file('image'));
            $bucket_name = config('oss.bucketName');
            OSS::publicUploadContent($bucket_name, $file_name, $content,['ContentType' => $content_type]);//设置HTTP头
            //获取公开文件URL
            $url = OSS::getPublicObjectURL($bucket_name, $file_name);
            $post->image=$file_name;
        }
        $post->save();
        //必须先保存后同步
        $post->tags()->sync($request->tags);
        Toastr::success('文章添加成功', 'OK');
        return redirect(route('admin.post.create'));
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function upload_img(Request $request)
    {
        if ($file=$request->upload) {
            //带扩展名的文件名
            $filenamewithextension=$file->getClientOriginalName();
            //不带扩展名的文件名
            $filename=pathinfo($filenamewithextension,PATHINFO_FILENAME);
            //文件扩展名
            $extention=$file->getClientOriginalExtension();
            //新的文件名
            $file_name =  'post/' . time() . rand(10, 99) . '.' .$extention;
            //上传文件至oss
            //文件类型
            $content_type= mime_content_type($file->getRealPath());
            $content = file_get_contents($file);
            $bucket_name = config('oss.bucketName');
            //存储于oss
            $result=OSS::publicUploadContent($bucket_name, $file_name, $content,['ContentType' => $content_type]);//设置HTTP头
            //获取公开文件URL
            $url = OSS::getPublicObjectURL($bucket_name, $file_name);
            if($result){
                $data=[
                    'uploaded'=>1,
                    'url'=>'http://'.$url,

                ];
            }
            return $data;
        }
    }
}
