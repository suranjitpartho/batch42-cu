<?php

namespace App\Providers;

use App\Models\ContentPage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.storefront', function ($view) {
            $socialLinks = [];
            if (Schema::hasTable('content_pages')) {
                $socialLinks = Cache::remember('social_links', 3600, function () {
                    $page = ContentPage::where('slug', 'social-media-links')->where('is_published', true)->first();
                    return $page ? (json_decode($page->getTranslation('content', 'en'), true) ?? []) : [];
                });
            }
            $view->with('socialLinks', $socialLinks);
        });
    }
}