<?php

namespace App\Providers;

use App\Events\ProcessCopiedTextEvent;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\ProcessCopiedTextController;

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
        Event::listen(ProcessCopiedTextEvent::class, ProcessCopiedTextController::class); 
    }
}
