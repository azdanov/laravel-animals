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
    /**
     * @return mixed[]
     */
    public function index(): string
    {
        return Category::all()->toJson();
    }

    /** @return mixed[] */
    public function store(Request $request): array
    {
        $category = Category::create($request->validate([
            'name' => 'required|unique:categories|max:255',
            'description' => 'required',
            'display_order' => 'required|numeric|unique:categories',
            'image' => 'required',
        ]));

        return ['id' => $category->id];
    }

    /** @return mixed[] */
    public function update(Request $request, Category $category): array
    {
        $category->update($request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'display_order' => 'required|numeric',
            'image' => 'required',
        ]));

        return ['id' => $category->id];
    }

    /**
     * @return mixed[]
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
