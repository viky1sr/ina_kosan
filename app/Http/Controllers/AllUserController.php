<?php

namespace App\Http\Controllers;

use App\Models\ActivationVendor;
use App\Models\User;
use App\Models\VirtualAccount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use DB;
use Yajra\DataTables\DataTables;

class AllUserController extends Controller
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
    public function visitorIndex() {
        $array = [
            'title' => '',
            'title_header' => 'Vendor',
        ];

        return view('pages.visitor.index',$array);
    }
    public function memberIndex() {
        $array = [
            'title' => '',
            'title_header' => 'Member',
        ];

        return view('pages.visitor.member_index',$array);
    }

    public function visitorDataTable(Request $request) {
        $data = User::with('roles')
        ->where('status','=',1)
        ->whereHas('roles',function($q){
            $q->where('name','=','vendor');
        });
        return datatables($data)->toJson();
    }

    public function memberDataTable(Request $request) {
        $data = User::where('status','=',1);
        return datatables($data)->toJson();
    }

    public function visitorCreate($id) {
        if(Auth::user()->hasRole('admin')) {
            $array = [
                'title' => 'Create Virtual Account',
                'title_header' => 'Visitor',
                'id' => $id
            ];
        } else if(Auth::user()->hasRole('visitor')) {
            $array = [
                'title' => 'Activation',
                'title_header' => 'Member',
                'id' => $id
            ];
        }
        return view('pages.visitor.create',$array);
    }

    public function visitorStore(Request $request,$id) {
        $req = $request->all();

        if(Auth::user()->hasRole('admin')){
            $validator = Validator::make($req,[
                'code_pin' => 'required',
                'tanggal_lahir' => 'required',
                'saldo' => 'required',
            ]);
        } elseif (Auth::user()->hasRole('visitor')){
            $validator = Validator::make($req,[
                'code_pin' => 'required',
                'tanggal_lahir' => 'required',
            ]);
        }

        if($validator->fails()) {
            return response()->json([
                'status' => 'fail',
                'messages' => $validator->errors()->first()
            ],422);
        }

        if($req['code_pin'] != $req['confirmation_code_pin']){
            return response()->json([
                'status' => 'fail',
                'messages' => 'Code Pin tidak sama..'
            ],422);
        }

        if(Auth::user()->hasRole('admin')){
            $search = ["Rp."," ",","];
            $saldo = str_replace($search,"",$req['saldo']);
        } elseif (Auth::user()->hasRole('visitor')) {
            $saldo = 0;
        }

        $input = [
          'id_users' => $id,
          'status' => 1,
          'code_virtual' => 0,
          'saldo' => $saldo,
          'code_pin' => $req['code_pin'],
          'tanggal_lahir' => $req['tanggal_lahir'],
        ];
        $cc = VirtualAccount::firstOrCreate($input);

        if($cc) {
            $created_year = Carbon::now()->format('Y');
            $tgl_lahir = Carbon::parse($req['tanggal_lahir'])->format('dmY');
            $concat = $created_year.''.$tgl_lahir.''.$cc->id;
            VirtualAccount::where('id',$cc->id)->update([
                'code_virtual' => $concat
            ]);
            $user = User::where('id',$id)->update([
                'status' => 1
            ]);

            DB::table('model_has_roles')->where('model_id',$id)
                ->update([
                    'role_id' => 2
                ]);
        }

        return response()->json([
            'status' => 'ok',
            'messages' => 'Success update visitor to member.',
            'route' => route('home')
        ],200);
    }


    public function listVendor() {
        $array = [
          'title' => 'List Vendor'
        ];
        return view('pages.vendor.index',$array);
    }

    public function listVendorShow($id) {
        $array = [
          'id' => $id,
          'data' => User::with('vendor')->find($id),
          'title' => 'Vendor Verification'
        ];
//        dd($array['data']);
        return view('pages.vendor.apply',$array);
    }

    public function listVendorApply(Request $request, $id) {
        $req = $request->all();

        if($req['status'] == null) {
            return response()->json([
                'status' => 'fail',
                'messages' => 'Please select status'
            ],422);
        }

        $user = User::find($id);
        $user->update([
          'status' => $req['status']
        ]);

        if($user->status == 1) {
            DB::table('model_has_roles')->where('model_id',$id)
                ->update([
                    'role_id' => 3
                ]);
        }
        return response()->json([
            'status' => 'ok',
            'messages' => 'Success update status.',
            'route' => route('vendor.list')
        ],200);
    }

    public function dataTables(){
        $data = User::with('vendor','roles')
            ->where('status','=',0)
            ->whereHas('roles', function ($q){
                $q->where('name','=','visitor');
            });

        return DataTables::of($data)
            ->make();
    }

    public function downloadFileVendor($id) {
        $file = ActivationVendor::where('id', $id)->firstOrFail();
        $pathToFile = public_path() . '/uploads/file_vendor/' . $file->file_pendukung;
        return response()->download($pathToFile);
    }
}
