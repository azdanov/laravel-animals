<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Pet;
use Exception;
use Illuminate\Support\Facades\Storage;

class PetsController extends Controller
{
    public function index(): string
    {
        return Pet::with('category')
            ->get()
            ->mapToGroups(static function ($pet) {
                return [$pet->category->name => $pet];
            })->toJson();
    }

    /**
     * @return mixed[]
     *
     * @throws Exception
     */
    public function destroy(Pet $pet): array
    {
        Storage::delete(config('app.image_path') . '/' . $pet->image);
        $pet->delete();

        return ['message' => 'Pet was deleted.'];
    }
}
