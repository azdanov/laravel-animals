<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use Exception;

class CategoryApiController extends Controller
{
    /**
     * @return mixed[]
     */
    public function index(): string
    {
        return Category::all()->toJson();
    }

    /**
     * @return mixed[]
     *
     * @throws Exception
     */
    public function destroy(Category $category): array
    {
        $category->delete();

        return ['message' => 'Category was deleted.'];
    }
}
