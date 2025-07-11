<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class AssetController extends Controller
{
    /**
     * Get specified file from storage
     */
    public function __invoke(string $path)
    {
        abort_if(!Storage::disk('public')->exists($path), 404);

        return response()->file(Storage::disk('public')->path($path));
    }
}
