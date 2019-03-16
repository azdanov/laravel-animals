<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Category;
use App\Pet;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use function compact;
use function view;

class PetsController extends Controller
{
    public function index(): Renderable
    {
        $categories = Category::with('pets')
            ->orderBy('display_order')
            ->get();

        return view('pets')->with(compact('categories'));
    }
}
