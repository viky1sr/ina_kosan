<?php

namespace App\Http\Controllers;

use App\Models\BuktiTransfer;
use App\Models\VirtualAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Yajra\DataTables\DataTables;

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

    public function buktiTrasnferIndex(){
        $array = [
            'title' => 'Transfer',
            'icon' => 'feather icon-user-check'
        ];
        return view('pages.bukti_transfer.index',$array);
    }

    public function buktiTrasnferCreate(){
        $array = [
            'title' => 'Create Transfer',
            'icon' => 'feather icon-user-check'
        ];
        return view('pages.bukti_transfer.create_or_apply',$array);
    }

    public function buktiTrasnferStore(Request $request){
        $req = $request->all();

        $validator = Validator::make($req,[
            'nominal' => 'required',
            'bukti_transfer' => 'required|mimes:jpg,jpeg,png,jfif|max:10000'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'fail',
                'messages' => $validator->errors()->first()
            ],422);
        }

        if ($request->hasFile('bukti_transfer')) {
            $file = $request->file('bukti_transfer');
            $file = $this->uploadBuktiTransfer($file);

            $search = ["."," ",",","Rp"];
            $nominal = str_replace($search,"",$req['nominal']);

            $input = [
                'user_id' => \Auth::user()->id,
                'nominal' => $nominal,
                'bukti_transfer' => $file->getFileInfo()->getFilename()
            ];
            BuktiTransfer::firstOrCreate($input);
            return response()->json([
                'status' => 'ok',
                'messages' => 'Success create bukti transfer.',
                'route' => route('bukti-trasnfer.index')
            ],200);
        }
    }

    public function applyCreate($id){
        $data = BuktiTransfer::with('user','vitual')->find($id);
        $val = $data->bukti_transfer;
        $image = asset('uploads/file_transfer') . '/' . $val;
//dd($data);
        $array = [
            'title' => 'Apply Transfer',
            'icon' => 'feather icon-user-check',
            'id' => $id,
            'members' => VirtualAccount::with('user')->whereHas('user', function ($q) {
                $q->where('status','=',1);
            })->get(),
            'data' => $data,
            'image' => $image
        ];
        return view('pages.bukti_transfer.create_or_apply',$array);
    }

    public function applyStore(Request $request, $id){

        $req = $request->all();

        $validator1 = Validator::make($req,[
            'status' => 'required',
        ]);

        if($validator1->fails()) {
            return response()->json([
                'status' => 'fail',
                'messages' => $validator1->errors()->first()
            ],422);
        }

        $bukti = BuktiTransfer::find($id);
        $bukti->update([
           'status' => $req['status']
        ]);

        if($bukti->status == 1){
            $check = BuktiTransfer::with('vitual')->find($id)->first();
            $search = ["."," ",",","Rp"];
            $checkSaldo = str_replace($search,"",$req['saldo']);

            if($check->vitual->code_virtual != $req['virtual_id']) {
                return response()->json([
                    'status' => 'fail',
                    'messages' => 'Member Virtual yang anda pilih salah.'
                ],422);
            }

            if($check->nominal != $checkSaldo){
                return response()->json([
                    'status' => 'fail',
                    'messages' => 'Nominal yang anda input tidak sama dengan bukti transfer.'
                ],422);
            }

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
                    'route' => route('bukti-trasnfer.index')
                ],200);
            }
        }
        return response()->json([
            'status' => 'ok',
            'messages' => 'Success apply bukti transfer.',
            'route' => route('bukti-trasnfer.index')
        ],200);
    }

    public function uploadBuktiTransfer(UploadedFile $file)
    {
        $destinationPath = public_path() . '/uploads/file_transfer/';
        $extension = $file->getClientOriginalExtension() ?: 'png';
        $fileName = $file->getClientOriginalName();
        return $file->move($destinationPath, $fileName);
    }

    public function dataTable(){
        if(\Auth::user()->hasRole('admin')){
            $data = BuktiTransfer::with('user','vitual');
        } else {
            $data = BuktiTransfer::with('user','vitual')->where('user_id','=',\Auth::user()->id);
        }

        return DataTables::of($data)
            ->addColumn('image', function ($q){
                $val = $q->bukti_transfer;
                $image = asset('uploads/file_transfer') . '/' . $val;
                return $image;
            })
            ->addColumn('is_status', function ($q){
                if($q->status == 0){
                    return 'pending';
                } else if($q->status == 1){
                    return 'Success';
                } else {
                    return 'Reject';
                }
            })
            ->addColumn('idr', function ($q){
              return rupiah($q->nominal);
            })
            ->addColumn('pengirim', function ($q){
                return $q->user->name.' - '.$q->vitual->code_virtual;
            })
            ->addIndexColumn(['image','is_status','idr','pengirim'])
            ->make(true);
    }

}
