<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use const PATHINFO_EXTENSION;
use const PATHINFO_FILENAME;
use function pathinfo;
use function str_replace;

class ImageController extends Controller
{
    /** @return mixed[] */
    public function store(Request $request): array
    {
        $file = $request->file('file');

        // FIXME: Bug with SVG extension guessing
        $filename = pathinfo($file->hashName(), PATHINFO_FILENAME);
        $extension = $file->guessExtension();
        if ($extension === null) {
            $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
        }

        $path = Storage::putFileAs(
            config('app.image_path'),
            $file,
            $filename . '.' . $extension
        );

        return ['message' => str_replace(config('app.image_path') . '/', '', $path)];
    }

    /** @return mixed[] */
    public function destroy(string $file): array
    {
        $status = Storage::delete(config('app.image_path') . '/' . $file);

        return ['message' => $status ? 'Image deleted' : 'Could not delete image'];
    }
}
