<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index(): string
    {
        return Category::select(
            ['id', 'name', 'description', 'display_order', 'image']
        )->get()->toJson();
    }

    /** @return array<string, int> */
    public function store(Request $request): array
    {
        $category = Category::create($request->validate([
            'name' => 'required|max:128|unique:categories',
            'description' => 'required|max:512',
            'display_order' => 'required|numeric|unique:categories',
            'image' => 'required',
        ]));

        return ['id' => $category->id];
    }

    /** @return array<string, int> */
    public function update(Request $request, Category $category): array
    {
        $category->update($request->validate([
            'name' => 'required|max:128|unique:categories,name,' . $category->id,
            'description' => 'required|max:512',
            'display_order' => 'required|numeric|unique:categories, display_order,' . $category->id,
            'image' => 'required',
        ]));

        return ['id' => $category->id];
    }

    /**
     * @return array<string, string>
     *
     * @throws Exception
     */
    public function destroy(Category $category): array
    {
        $category->pets()->each(static function ($pet): void {
            Storage::delete(config('app.image_path') . '/' . $pet->image);
        });
        $category->pets()->delete();

        Storage::delete(config('app.image_path') . '/' . $category->image);
        $category->delete();

        return ['message' => 'Category was deleted.'];
    }
}
