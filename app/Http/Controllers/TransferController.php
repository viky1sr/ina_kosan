<?php

namespace App\Http\Controllers;

use App\Models\VirtualAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransferController extends Controller
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

    public function transferIndex(){
        $array = [
            'title' => 'to member',
            'title_header' => 'Transfer',
            'members' => VirtualAccount::with('user')->whereHas('user', function ($q) {
                $q->where('status','=',1);
            })->get(),

        ];
//        dd($array['members']);

        return view('pages.virtual_acc.transfer_create',$array);
    }

    public function transferStore(Request $request) {
        $req = $request->all();
        $validator = Validator::make($req,[
            'virtual_id' => 'required',
            'saldo' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 'fail',
                'messages' => $validator->errors()->first()
            ],422);
        } else {
            $findCc = VirtualAccount::where('code_virtual','=',$req['virtual_id'])->first();
            $search = ["."," ",",","Rp"];
            $saldo = str_replace($search,"",$req['saldo']);
            $calcu = (int) $findCc->saldo + (int) $saldo;
            VirtualAccount::where('code_virtual','=',$req['virtual_id'])
                ->update([
                    'saldo' => $calcu
                ]);
            return response()->json([
                'status' => 'ok',
                'messages' => 'Success transfer to member.',
                'route' => route('home')
            ],200);
        }
    }
}
