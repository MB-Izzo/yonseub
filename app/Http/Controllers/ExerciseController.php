<?php

namespace App\Http\Controllers;

use Gemini\Data\GenerationConfig;
use Gemini\Enums\DataType;
use Gemini\Enums\ResponseMimeType;
use Gemini\Data\Schema;
use Gemini\Laravel\Facades\Gemini;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use function GuzzleHttp\json_decode;

class ExerciseController extends Controller
{
    public function generate(Request $request): Response
    {
        $words = \App\Models\Word::where('user_id', Auth::id())->inRandomOrder()->limit(10)->get();
        $wordArray = $words->pluck('word')->toArray();
        $string = implode(" ", $wordArray);
        $result = Gemini::generativeModel(model: 'gemini-2.0-flash')
            ->withGenerationConfig(
                generationConfig: new GenerationConfig(
                    responseMimeType: ResponseMimeType::APPLICATION_JSON,
                    responseSchema: new Schema(
                        type: DataType::ARRAY,
                        items: new Schema(
                            type: DataType::OBJECT,
                            properties: [
                                'sentence' => new Schema(type: DataType::STRING),
                                'translated' => new Schema(type: DataType::STRING),
                            ],
                            required: ['sentence', 'translated'],
                        )
                    )
                )
            )->generateContent('Give me a sentence in french that I should translate in korean. It should contain no more and no less than TWO words from this list: ' . $string . ' Not more, not less. And should make sense. Only give the FRENCH sentence. dont use the KOREAN WORDS. You can extrapolate words like if you see 회의 you can use 회의하다 of course (same for 되다 words). NEVER USE HANGEUL. The sentence should make sense in french. For the translated field, give me the sentence in korean (요 polite ending.');


        $data = $result->json();
        $sentence = $data[0]->sentence ?? null; // Use null as fallback if the array is empty
        //return redirect()->route('loggedApp')->with('sentence', $sentence);
        return Inertia::render('loggedApp', [
            'sentence' => $data[0] ?? null,
        ]);
    }
}
