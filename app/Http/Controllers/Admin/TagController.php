<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TagRequest;
use App\Models\Post_tag;
use App\Models\Tag;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags=DB::table('tags')->orderBy('updated_at', 'desc')->get();
        return view('admin.tag_index',compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tag_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request,Tag $tag)
    {
        $tag->fill($request->all());
        $tag->save();
        Toastr::success('标签添加成功', 'OK');
        return redirect(route('admin.tag.index'));
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
        $tag= Tag::find($id);
        return view('admin.tag_edit',compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TagRequest $request,Tag $tag)
    {
        $tag->fill($request->all());
        $tag->save();
        Toastr::success('标签修改成功', 'OK');
        return redirect(route('admin.tag.index'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Post_tag::where('tag_id',$id)->count()){
           Toastr::error('删除不成功', 'OK');
        }else{
            Tag::where('id',$id)->delete();
            Toastr::success('删除成功', 'OK');
        }
       return redirect() ->back();

    }
}
