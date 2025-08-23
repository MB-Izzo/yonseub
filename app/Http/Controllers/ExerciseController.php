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

class ExerciseController extends Controller
{
    public function generate(Request $request): Response
    {
        // Efficient random selection for large tables
        $ids = \App\Models\Word::where('user_id', Auth::id())->pluck('id')->toArray();
        $randomIds = [];
        if (count($ids) > 0) {
            $keys = (array) array_rand($ids, min(5, count($ids)));
            foreach ($keys as $key) {
                $randomIds[] = $ids[$key];
            }
        }
        $words = \App\Models\Word::whereIn('id', $randomIds)->get();
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
            )->generateContent('Generate a natural French sentence that a native speaker would say, using exactly two words from this list (of course, translate these words to french, dont use it as is): ' . $string . '. \n\n
                Instructions:\n
                - The French sentence (the \'sentence\' field) must use only Latin alphabet characters. Do NOT use any Korean words or Hangeul characters (e.g., 가, 나, 다, etc.) in the French sentence. If you use any Korean word or Hangeul, your answer is invalid.\n
                - Hangeul is the Korean writing system (characters like: 가, 나, 다, etc).\n- Integrate the two words seamlessly so the sentence makes sense in context.\n
                - For the \'sentence\' field, provide only the French sentence.\n
                - For the \'translated\' field, provide the Korean translation using the 요 polite ending.\n
                - Example (good):\n  sentence: \'J\'ai une réunion importante demain.\'\n  translated: \'내일 중요한 회의가 있어요.\'\n
                - Example (bad):\n  sentence: \'Le 비결 pour 오다 à bout de ce projet est simple.\' (contains Hangeul/Korean words, INVALID)\n
                sentence: \'내일 회의가 있어요.\' (contains Hangeul, INVALID)\n- Return only the JSON array as specified in the schema.');

        $data = $result->json();
        return Inertia::render('loggedApp', [
            'sentence' => $data[0] ?? null,
        ]);
    }
}
