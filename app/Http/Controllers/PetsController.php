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

    public function create(): void
    {
    }

    public function store(Request $request): void
    {
    }

    public function show(Pet $pet): void
    {
    }

    public function edit(Pet $pet): void
    {
    }

    public function update(Request $request, Pet $pet): void
    {
    }

    public function destroy(Pet $pet): void
    {
    }
}
