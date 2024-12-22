<?php

namespace App\Providers;

use Native\Laravel\Facades\MenuBar;
use Native\Laravel\Contracts\ProvidesPhpIni;
use Native\Laravel\Facades\GlobalShortcut;
use Illuminate\Support\Facades\Artisan;
use App\Models\Information;
use Database\Seeders\InformationSeeder;

use App\Events\ProcessCopiedTextEvent;

class NativeAppServiceProvider implements ProvidesPhpIni
{
    /**
     * Executed once the native application has been booted.
     * Use this method to open windows, register global shortcuts, etc.
     */
    public function boot(): void
    {
        if(Information::count() === 0) {
            Artisan::call('db:seed', ['--class' => InformationSeeder::class]);
        }

        MenuBar::create()
            ->icon(storage_path('app/menuBarIconTemplate.png'))
            ->width(550)
            ->height(415)
            ->resizable(false);
                    
        GlobalShortcut::key('CmdOrCtrl+Alt+C')
        ->event(ProcessCopiedTextEvent::class)
        ->register();
    }

    /**
     * Return an array of php.ini directives to be set.
     */
    public function phpIni(): array
    {
        return [
        ];
    }
}
