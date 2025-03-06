<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    private $cacheKey = 'languages';
    private $storeKey = 'data_language';

    public function index(): JsonResponse
    {
        $languages = Cache::store($this->storeKey)->get($this->cacheKey, []);
        return response()->json([
            'total' => count($languages),
            'data' => $languages,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'language' => 'required|string',
                'appeared' => 'required|integer',
                'created' => 'required|array',
                'functional' => 'required|boolean',
                'object_oriented' => 'required|boolean',
                'relation.influenced_by' => 'required|array',
                'relation.influences' => 'required|array',
            ]);

            $languages = Cache::store($this->storeKey)->get($this->cacheKey, []);

            $newId = count($languages) + 1;
            $newData = array_merge($request->all(), ['id' => $newId]);
            $languages[] = $newData;

            Cache::store($this->storeKey)->forever($this->cacheKey, $languages);

            return response()->json(['message' => 'Language added successfully'], 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }

    public function show(int $id): JsonResponse
    {
        $languages = Cache::store($this->storeKey)->get($this->cacheKey, []);
        $language = collect($languages)->firstWhere('id', $id);

        if (!$language) {
            return response()->json(['error' => 'Language not found'], 404);
        }

        return response()->json($language);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        try {
            $data = $request->validate([
                'language' => 'required|string',
                'appeared' => 'required|integer',
                'created' => 'required|array',
                'functional' => 'required|boolean',
                'object_oriented' => 'required|boolean',
                'relation.influenced_by' => 'required|array',
                'relation.influences' => 'required|array',
            ]);

            $languages = Cache::store($this->storeKey)->get($this->cacheKey, []);
            $index = array_search($id, array_column($languages, 'id'));

            if ($index === false) {
                return response()->json(['error' => 'Language not found'], 404);
            }

            $languages[$index] = array_merge($data, ['id' => $id]);

            Cache::store($this->storeKey)->forever($this->cacheKey, $languages);

            return response()->json(['message' => 'Language updated successfully']);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        $languages = Cache::store($this->storeKey)->get($this->cacheKey, []);
        $exists = collect($languages)->firstWhere('id', $id);

        if (!$exists) {
            return response()->json(['error' => 'Language not found'], 404);
        }

        $languages = array_values(array_filter($languages, fn ($lang) => $lang['id'] !== $id));
        
        Cache::store($this->storeKey)->forever($this->cacheKey, $languages);

        return response()->json(['message' => 'Language deleted successfully']);
    }
}
