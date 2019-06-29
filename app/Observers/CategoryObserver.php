<?php

namespace App\Observers;

use App\Handlers\SlugTranslateHandler;

use App\Jobs\TranslateCategorySlug;
use App\Models\Category;

class CategoryObserver
{
    public function saved(Category $category)
    {
        // 如 slug 字段无内容，即使用翻译器对 title 进行翻译
        if (!$category->slug) {
            // 推送任务到队列
            dispatch(new TranslateCategorySlug($category));
        }


    }

    public function updating(Category $category)
    {

          dispatch(new TranslateCategorySlug($category));

    }
}
