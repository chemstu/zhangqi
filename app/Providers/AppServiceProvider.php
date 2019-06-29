<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Tag;
use App\Observers\CategoryObserver;
use App\Observers\TagObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //避免1071错误
        Schema::defaultStringLength(191);
        \Carbon\Carbon::setLocale('zh');
        Tag::observe(TagObserver::class);
        Category::observe(CategoryObserver::class);

    }
}
