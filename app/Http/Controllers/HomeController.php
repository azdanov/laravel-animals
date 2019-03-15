<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Contracts\Support\Renderable;
use function compact;
use function view;

class HomeController extends Controller
{
    public function index(): Renderable
    {
        $categories = Category::orderBy('display_order')->get();

        return view('home')->with(compact('categories'));
    }
}
