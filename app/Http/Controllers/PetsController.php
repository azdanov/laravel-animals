<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Pet;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use function view;

class PetsController extends Controller
{
    public function index(): Renderable
    {
        return view('pets');
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
