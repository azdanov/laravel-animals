<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Pet;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PetsController extends Controller
{
    public function index(): string
    {
        return Pet::with('category')
            ->get()
            ->mapToGroups(static function ($pet) {
                return [$pet->category->name => $pet];
            })->toJson();
    }

    /** @return array<string, int> */
    public function store(Request $request): array
    {
        $pet = Pet::create($request->validate([
            'name' => 'required|unique:categories|max:255',
            'description' => 'required',
            'image' => 'required',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]));

        return ['id' => $pet->id];
    }

    /** @return array<string, int> */
    public function update(Request $request, Pet $pet): array
    {
        $pet->update($request->validate([
            'name' => 'required|unique:categories,name,' . $pet->id . '|max:255',
            'description' => 'required',
            'image' => 'required',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]));

        return ['id' => $pet->id];
    }

    /**
     * @return array<string, string>
     *
     * @throws Exception
     */
    public function destroy(Pet $pet): array
    {
        Storage::delete(config('app.image_path') . '/' . $pet->image);
        $pet->delete();

        return ['message' => 'Pet was deleted.'];
    }
}
