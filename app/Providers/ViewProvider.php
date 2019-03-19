<?php

declare(strict_types=1);

namespace App\Providers;

use Auth;
use Cart;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer(
            'partials.navbar',
            static function (\Illuminate\View\View $view): void {
                $userId = Auth::id();

                if ($userId === null) {
                    return;
                }

                Cart::session($userId);

                $view->with(['cart_total' => Cart::getTotalQuantity()]);
            }
        );
    }
}