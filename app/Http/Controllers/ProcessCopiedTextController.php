<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Information;
use Native\Laravel\Facades\Clipboard;
use Native\Laravel\Facades\Notification;
use OpenAI;
use Illuminate\Support\Facades\Log;

class ProcessCopiedTextController extends Controller
{
    public function __invoke(){

        $information = Information::first();
        $prompt = $information->prompt;
        $copiedText = Clipboard::text();

        if(!$information){
            Notification::title('Rewrite GPT')
            ->message('Please add your OpenAI API key in the settings.')
            ->show();

            return response()->json(['error' => 'Please add your OpenAI API key in the settings.']);
        }

        try{
            $client = OpenAI::client($information->api_key);
            $result = $client->chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'user', 'content' => $prompt . $copiedText],
                ],
            ]);
    
            $rewrittenText = $result->choices[0]->message->content;
            Clipboard::text($rewrittenText);
    
            Notification::title('Rewrite GPT')
                ->message('Your text has been rewritten and copied to the clipboard.')
                ->show();
    
            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Notification::title('Rewrite GPT')
                ->message('Invalid API key or API error. Please check your settings.')
                ->show();
            
            return response()->json([
                'error' => 'API Error',
                'message' => $e->getMessage()
            ], 401)
            ->header('Content-Type', 'application/json');
        }
    }
}
