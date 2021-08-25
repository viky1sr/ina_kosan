<?php

namespace App\Http\Controllers;

use App\Models\RoomKosan;
use Illuminate\Http\Request;

class LadingPageController extends Controller
{
    public function index(Request $request) {
        $array = [
            'kosans' => RoomKosan::with('file','is_type')->paginate(5),
        ];

//        dd($array['kosans']);

        return view('pages.frontend',$array);
    }
}
