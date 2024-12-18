<?php

namespace App\Providers;

use App\Events\ProcessCopiedTextEvent;
use Illuminate\Support\Facades\Event;
use Native\Laravel\Facades\Clipboard;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
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
        Event::listen(ProcessCopiedTextEvent::class, function ($event) {
            $copiedText = Clipboard::text();
            Log::info('Copied text processed: ' . $copiedText);
        });
    }
}
