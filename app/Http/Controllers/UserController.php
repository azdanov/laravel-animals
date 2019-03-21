<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __invoke(Request $request): Renderable
    {
        return view('user');
    }
}
