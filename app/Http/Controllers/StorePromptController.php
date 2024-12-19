<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Information;
use Illuminate\Support\Facades\Log;

class StorePromptController extends Controller
{
    public function __invoke(Request $request){

        $validated = $request->validate([
            'prompt' => 'required|integer',
            'language' => 'string'
        ]);

        $prompt = '';

        if($validated['prompt'] == 1){
            $prompt = 'Rewrite the following sentence: ';
        }

        if($validated['prompt'] == 2){
            $prompt = 'In the ' . $validated['language'] . ' language, rewrite the following sentence: ';
        }

        Log::info($prompt);

        $information = Information::first();

        if($information){
            $information->update(['prompt' => $prompt]);
        }

        if(!$information){
            Information::create(['prompt' => $prompt]);
        }

        return response()->json(['success' => true]);
    
    }
}
