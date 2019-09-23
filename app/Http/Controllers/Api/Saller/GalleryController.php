<?php

namespace App\Http\Controllers\Api\Saller;

use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
    public function getGalleries(Request $request)
    {
        # code...
        $gallery = Gallery::where('galleryable_id', $request->product_id)->get();
        return response()->json([
            'gallery' => $gallery
        ]);
    }
}
?>