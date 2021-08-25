<?php

namespace App\Http\Controllers;

use App\Models\KontrakSewa;
use App\Models\RoomKosan;
use App\Models\VirtualAccount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $my_kosan = KontrakSewa::where('id_users','=',Auth::user()->id)->first();
        $search = ['bulan'," "];
        $lama_sewa = str_replace($search,"",$my_kosan->lama_sewa ?? null) ?? null;
        $masa_sewa = (int) $lama_sewa ?? 0;
        $awal_sewa = $my_kosan->mulai_sewa ?? null;
        $created_at = $my_kosan->created_at ?? null;
        $array = [
            'campur' => count(RoomKosan::where('type','=',1)->get()),
            'pria' => count(RoomKosan::where('type','=',2)->get()),
            'wanita' => count(RoomKosan::where('type','=',3)->get()),
            'check_sewa' => Carbon::now()->between(Carbon::parse($created_at) , Carbon::parse($awal_sewa)->addMonth($masa_sewa)) ? '1' : '0',
            'earnings' => VirtualAccount::where('id_users','=',Auth::user()->id)->first()
        ];

        return view('pages.dashboard',$array);
    }
}
