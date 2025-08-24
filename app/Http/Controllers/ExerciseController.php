<?php

namespace App\Http\Controllers;

use Gemini\Data\GenerationConfig;
use Gemini\Enums\DataType;
use Gemini\Enums\ResponseMimeType;
use Gemini\Data\Schema;
use Gemini\Laravel\Facades\Gemini;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class ExerciseController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'sentence' => 'required|string|max:255',
            'translation' => 'required|string|max:255',
        ]);

        \App\Models\Exercise::create([
            'sentence' => $request->sentence,
            'translation' => $request->translation,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Exercise created successfully!');       //
    }

    public function index()
    {
        $userExercises = \App\Models\Exercise::where('user_id', Auth::id())->latest()->get();
        return Inertia::render('myExercises', [
            'exercises' => $userExercises,
        ]);
    }

    public function generate(Request $request): Response
    {
        // Efficient random selection for large tables
        $ids = \App\Models\Word::where('user_id', Auth::id())->pluck('id')->toArray();
        $randomIds = [];
        if (count($ids) > 0) {
            $keys = (array) array_rand($ids, min(1, count($ids)));
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
            )->generateContent('Generate a natural korean sentence that a native speaker would say, using a few of the most 5000 most used korean words (of course, translate these words to french, dont use it as is). You should first get the sentence in korean and then translate it.: . \n\n
                Instructions:\n
                - The French sentence (the \'sentence\' field) must use only Latin alphabet characters. Do NOT use any Korean words or Hangeul characters (e.g., 가, 나, 다, etc.) in the French sentence. If you use any Korean word or Hangeul, your answer is invalid.\n
                - Hangeul is the Korean writing system (characters like: 가, 나, 다, etc).\n
                - Integrate the two words seamlessly so the sentence makes sense in context.\n
                - You can use variants of the words given, like if I gave 소외하다 you can use 소외되다. \n
                - If I give a word (like 계량) you can use the verb form too (like 계량하다) if necessary.
                - If I give conjugated form you can use it with another form/tense.\n
                - The translated sentence should be CORRECT. \n
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

    public function generateWithInput(Request $request): Response
    {
        $request->validate([
            'words' => 'required|string|max:255',
        ]);
        $inputWords = $request->words;

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
            )->generateContent('Generate a natural French sentence that a native speaker would say, using exactly one word from this list (of course, translate these words to french, dont use it as is): ' . $inputWords . '. \n\n
                Instructions:\n
                - The French sentence (the \'sentence\' field) must use only Latin alphabet characters. Do NOT use any Korean words or Hangeul characters (e.g., 가, 나, 다, etc.) in the French sentence. If you use any Korean word or Hangeul, your answer is invalid.\n
                - Hangeul is the Korean writing system (characters like: 가, 나, 다, etc).\n
                - Integrate the two words seamlessly so the sentence makes sense in context.\n
                - You can use variants of the words given, like if I gave 소외하다 you can use 소외되다. \n
                - If I give a word (like 계량) you can use the verb form too (like 계량하다) if necessary.
                - If I give conjugated form you can use it with another form/tense.\n
                - The sentence field should have the word used from the list I gave you between * tags *.\n
                - The translated sentence should be CORRECT. \n
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
