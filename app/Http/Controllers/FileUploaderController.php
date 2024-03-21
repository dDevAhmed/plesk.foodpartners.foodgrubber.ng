<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class FileUploaderController extends Controller
{
    // public function getFile(string $filepath)
    // {
    //     if (!Storage::disk('local')->exists('img/products/' . $filepath)) {
    //         return response()->json([
    //             "status" => "error",
    //             "message"=> "File not found"
    //         ]);
    //     }
    //     return Storage::response($filepath);
    // }
}
