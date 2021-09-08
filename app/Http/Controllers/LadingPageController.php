<?php

namespace App\Http\Controllers;

use App\Models\RoomKosan;
use Illuminate\Http\Request;

class LadingPageController extends Controller
{
    public function index(Request $request) {
        $array = [
            'kosans' => RoomKosan::with('file','is_type','fasilitas')->paginate(4),
        ];

        return view('pages.frontend',$array);
    }
}
