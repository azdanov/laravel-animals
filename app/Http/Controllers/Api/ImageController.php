<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use function str_replace;

class ImageController extends Controller
{
    /** @var string */
    private $directory = 'public/images';

    /** @return mixed[] */
    public function store(Request $request): array
    {
        $file = $request->file('file');
        $path = $file->store($this->directory);

        return ['message' => str_replace($this->directory . '/', '', $path)];
    }

    /** @return mixed[] */
    public function destroy(string $file): array
    {
        $status = Storage::delete($this->directory . '/' . $file);

        return ['message' => $status ? 'Image deleted' : 'Could not delete image'];
    }
}
