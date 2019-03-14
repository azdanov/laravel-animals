<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use function view;

class AboutController extends Controller
{
    public function index(): Renderable
    {
        return view('about');
    }
}
