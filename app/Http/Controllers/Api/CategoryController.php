<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

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
        Category::create($request->validate([
            'name' => 'required|unique:categories|max:255',
            'description' => 'required',
            'display_order' => 'required|numeric|unique:categories',
            'image' => 'required',
        ]));

        return ['message' => 'Category was created'];
    }

    /**
     * @return mixed[]
     *
     * @throws Exception
     */
    public function destroy(Category $category): array
    {
        $category->pets()->delete();
        $category->delete();

        return ['message' => 'Category was deleted.'];
    }
}
