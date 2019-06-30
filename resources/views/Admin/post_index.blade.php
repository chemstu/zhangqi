@extends('admin.layouts.app')

@section('page-css')

    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/select2_metro.css')}}" />

    <link rel="stylesheet" href="{{asset('admin/css/DT_bootstrap.css')}}" />

@endsection

@section('content')

    <!-- BEGIN PAGE -->


    <div class="page-content">

        <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->


        <!-- BEGIN PAGE CONTAINER-->

        <div class="container-fluid">

            <!-- BEGIN PAGE HEADER-->

            <div class="row-fluid">

                <div class="span12">

                    <h3 class="page-title">

                        文章列表

                    </h3>

                </div>

            </div>

            <div class="row-fluid">

                <div class="responsive" >

                    <!-- BEGIN EXAMPLE TABLE PORTLET-->

                    <div class="portlet box purple">

                        <div class="portlet-title">

                            <div class="caption"><i class="icon-cogs"></i>列表</div>

                            <div class="actions">

                                <a href="{{route('admin.post.create')}}" class="btn green"><i class="icon-plus"></i>新增</a>

                                <a href="#" class="btn yellow"><i class="icon-print"></i> 导出</a>

                            </div>

                        </div>

                        <div class="portlet-body">

                            <table class="table table-striped table-bordered table-hover" id="datatable">

                                <thead>

                                <tr>

                                    <th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#datatable .checkboxes" /></th>

                                    <th>文章标题</th>

                                    <th class="hidden-480">所属分类</th>

                                    <th class="hidden-480">状态</th>

                                    <th >编辑</th>

                                </tr>

                                </thead>

                                <tbody>

                                @foreach($posts as $post)

                                    <tr class="odd gradeX">

                                        <td><input type="checkbox" class="checkboxes" value="1" /></td>

                                        <td>{{$post->title}}</td>

                                        <td class="hidden-480"><a href="{{route('category',$post->category->id)}}" target="_blank">{{$post->category->name}}</a></td>

                                        @if($post->status==0)
                                        <td class="hidden-480" ><span class="label label-success">私有</span></td>
                                        @else
                                         <td class="hidden-480" ><span class="label label-success">公开</span></td>
                                        @endif

                                        <td>
                                            <span class="icon-eye-open" style="margin:10px,10px"> <a href="{{route('post',$post->id)}}" target="_blank">查看</a> </span>

                                            <span class="icon-edit"  style="margin-left: 10px"> 编辑 </span>

                                            <span class="icon-trash" style="margin-left: 10px" > <a href="javascript:;" onclick="delLink({{$post->id}})"  ">删除 </a>

                                                <form id="delete-form-{{ $post->id }}" action="{{ route('admin.post.destroy',$post->id) }}" method="POST" style="display: none;">
                                            @csrf
                                                    @method('DELETE')
                                        </form> </span>

                                        </td>
                                    </tr>

                                @endforeach

                                </tbody>

                            </table>

                        </div>

                    </div>

                    <!-- END EXAMPLE TABLE PORTLET-->

                </div>

            </div>

            <!-- END PAGE CONTENT-->

        </div>

        <!-- END PAGE CONTAINER-->

    </div>

    <!-- END PAGE -->


@endsection

@section('page-js')

    <script type="text/javascript" src="{{asset('admin/js/select2.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('admin/js/jquery.dataTables.js')}}"></script>

    <script type="text/javascript" src="{{asset('admin/js/DT_bootstrap.js')}}"></script>

    <script src="{{asset('admin/js/table-managed.js')}}"></script>


    <script src="{{asset('alert/jquery-confirm.min.js')}}"></script>

    <link rel="stylesheet" href="{{asset('alert/jquery-confirm.min.css')}}" />

    <script type="text/javascript">

        function delLink(id) {
            $.confirm({
                //设置icon及其大小 ，大小可为fa-lg (33% 递增), fa-2x, fa-3x, fa-4x, 或 fa-5x
                icon: 'fa fa-exclamation-triangle fa-2x',
                closeIcon: true,
                //设置对话框的宽度
                boxWidth: '40%',
                useBootstrap: false,
                //设置对话框的样式 ，可以为light\dark\modern\'material'\'bootstrap\supervan'
                theme: 'modern',
                title: '确定删除所选信息?',
                content: '一旦删将无法恢复',
                autoClose: '取消|5000', //必须与下面的取消相同
                type: 'red',
                buttons: {
                    删除: {
                        text: '删除',
                        btnClass: 'btn-red', //按钮颜色
                        action: function () {
                            event.preventDefault();
                            document.getElementById('delete-form-'+id).submit();
                        }
                    },
                    取消: function () {
                        //点击取消按钮后显示
                        // $.alert('action is canceled');
                    }
                }
            });

        }
    </script>

    <script>

        jQuery(document).ready(function() {

            TableManaged.init();

        });

    </script>



@endsection