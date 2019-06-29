<?php

namespace App\Observers;

use App\Handlers\SlugTranslateHandler;
use App\Jobs\TranslateTagSlug;
use App\Models\Tag;

class TagObserver
{
    public function saved(Tag $tag)
    {
        dispatch(new TranslateTagSlug($tag));
    }


    public function updating(Tag $tag)
    {
        dispatch(new TranslateTagSlug($tag));
    }

}
