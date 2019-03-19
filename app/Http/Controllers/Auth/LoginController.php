<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use function compact;
use function view;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /** @var string */
    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm(): Renderable
    {
        $user = User::whereId('1')->first();

        return view('auth.login')->with(compact('user'));
    }
}
