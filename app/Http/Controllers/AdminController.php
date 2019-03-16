<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use function view;

class AdminController extends Controller
{
    public function __invoke(Request $request): Renderable
    {
        return view('admin');
    }
}
