<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use function str_replace;

class ImageController extends Controller
{
    /** @return mixed[] */
    public function store(Request $request): array
    {
        $file = $request->file('file');
        $dir = 'public/images';
        $path = $file->store($dir);

        return ['message' => str_replace("${dir}/", '', $path)];
    }
}
