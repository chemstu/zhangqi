<?php

namespace App\Http\Controllers\Admin;

use App\Services\OSS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class FileController extends Controller
{
    //文件上传方法
    public function upload(){
       $file=Input::file('myfile');
       if($file->isValid()){
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
           $filePath = OSS::getPublicObjectURL($bucket_name, $file_name);

          if ($result) {
               $data = [
                   'status' => 0,
                   'filePath'=>'http://'.$filePath,
               ];
           }
           return $data;
       }
    }

}

