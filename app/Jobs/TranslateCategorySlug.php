<?php

namespace App\Jobs;

use App\Handlers\SlugTranslateHandler;
use App\Models\Category;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;

class TranslateCategorySlug implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $category;

    public function __construct(Category $category)
    {
        // 队列任务构造器中接收了 Eloquent 模型，将会只序列化模型的 ID
        $this->category = $category;
    }

    public function handle()
    {
        // 请求百度 API 接口进行翻译
        $slug = app(SlugTranslateHandler::class)->translate($this->category->name);

        // 为了避免模型监控器死循环调用，我们使用 DB 类直接对数据库进行操作
        DB::table('categories')->where('id', $this->category->id)->update(['slug' => $slug]);
    }
}

