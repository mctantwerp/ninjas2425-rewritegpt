<?php

namespace App\Providers;

use App\Events\ProcessCopiedTextEvent;
use Illuminate\Support\Facades\Event;
use Native\Laravel\Facades\Clipboard;
use Illuminate\Support\ServiceProvider;
use Native\Laravel\Facades\Notification;
use OpenAI\Laravel\Facades\OpenAI;

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

            $result = OpenAI::chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'user', 'content' => 'Rewrite the following sentence: ' . $copiedText],
                ],
            ]);

            $rewrittenText = $result->choices[0]->message->content;

            Clipboard::text($rewrittenText);

            Notification::title('Rewrite GPT')
            ->message('Your text has been rewritten and copied to the clipboard.')
            ->show();
        });
    }
}
