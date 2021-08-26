<?php

namespace App\Http\Controllers;

use App\Models\FasilitasRoom;
use App\Models\FileKosan;
use App\Models\InfoPembayaranBulanan;
use App\Models\KontrakSewa;
use App\Models\LogPembayaran;
use App\Models\MasterLamaSewa;
use App\Models\RoomKosan;
use App\Models\VirtualAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Auth;

class AllKosKosanController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexCampur()
    {
        $array = [
            'title' => 'Campur',
            'title_header' => 'Kos Kosan',
        ];

        return view('pages.kos_kosan.index_campur',$array);
    }

    public function indexPria()
    {
        $array = [
            'title' => 'Pria',
            'title_header' => 'Kos Kosan',
        ];

        return view('pages.kos_kosan.index_pira',$array);
    }

    public function indexWanita()
    {
        $array = [
            'title' => 'Wanita',
            'title_header' => 'Kos Kosan',
        ];

        return view('pages.kos_kosan.index_wanita',$array);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $array = [
            'title' => 'Create',
            'title_header' => 'Kos Kosan',
        ];

        return view('pages.kos_kosan.create_or_update',$array);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $req = $request->all();

        $validator = Validator::make($req,[
            'name' => 'required',
            'type' => 'required',
            'price' => 'required',
            'location' => 'required',
            'description' => 'required',
            'map' => 'required',
            'file_kosan' => 'required|mimes:jpg,jpeg,png,jfif|max:25000'
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 'fail',
                'messages' => $validator->errors()->first()
            ],422);
        }

        $search = ['Rp','.',' '];
        $input = [
            'name' => $req['name'],
            'type' => $req['type'],
            'price' => str_replace($search,"",$req['price']),
            'location' => $req['location'],
            'description' => $req['description'],
            'map' => $req['map']
        ];
        $success = RoomKosan::firstOrCreate($input);

        if($success) {
            $fasilitasInput = [
                'id_room_kosans' => $success->id,
                'fasilitas_name' => $req['fasilitas_name'],
            ];
            FasilitasRoom::firstOrCreate($fasilitasInput);

            if ($request->hasFile('file_kosan')) {
                $file = $request->file('file_kosan');
                $file = $this->uploadFileKosan($file);

                $product_input = [
                    'id_room_kosans' => $success->id,
                    'file_kosan' => $file->getFileInfo()->getFilename()
                ];
                FileKosan::firstOrCreate($product_input);
            }

            if($success->type == 1) {
                $route = route('kos-kosan.campur-index');
            }elseif ($success->type == 2) {
                $route = route('kos-kosan.pria-index');
            } elseif ($success->type == 3) {
                $route = route('kos-kosan.wanita-index');
            }

            return response()->json([
                'status' => 'ok',
                'messages' => 'Success Create Kosan Kosan.',
                'route' => $route
            ],200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function payNowShow(Request $request, $id){
        $array = [
            'id' => $id,
            'title' => 'Kontrak Sewa',
            'title_header' => 'Kos Kosan',
            'data' => RoomKosan::with('fasilitas')->find($id),
            'bulans' => MasterLamaSewa::all()->pluck('bulan','id')
        ];

        return view('pages.kos_kosan.pay_now',$array);
    }

    public function payNowStore(Request $request, $id){
        $req = $request->all();
        $virtual = VirtualAccount::where('id_users',Auth::user()->id)->first();
        $kosan = RoomKosan::find($id)->first();

        if($virtual->saldo < $kosan->price) {
            return response()->json([
                'status' => 'fail',
                'messages' => 'Saldo anda tidak mencukupin silakan isi saldo anda.'
            ],422);
        }

        if($virtual->code_pin != $req['code_pin']) {
            return response()->json([
                'status' => 'fail',
                'messages' => 'Code Pin anda salah.'
            ],422);
        }

        $msg = [
            'mulai_sewa.required' => 'Silakan pilih tanggal mulai sewa.',
            'lama_sewa.required' => 'Silakan pilih lama sewa.',
        ];
        $validator = Validator::make($req,[
            'mulai_sewa' => 'required',
            'lama_sewa' => 'required',
        ],$msg);

        if($validator->fails()) {
            return response()->json([
                'status' => 'fail',
                'messages' => $validator->errors()->first()
            ],422);
        }

        $input = [
          'id_users' => Auth::user()->id,
          'id_room_kosans' => $req['id'],
          'status' => 1,
          'mulai_sewa' => $req['mulai_sewa'],
          'lama_sewa' => $req['lama_sewa'],
        ];

        $success = KontrakSewa::firstOrCreate($input);

        if($success) {
            $inputPembayaran = [
                'id_users' => Auth::user()->id,
                'id_virtual_accounts' => $virtual->id,
                'status' => 1,
                'payment' => $req['payment'],
                'payment_date' => $req['mulai_sewa']
            ];
            $cal =  InfoPembayaranBulanan::firstOrCreate($inputPembayaran);

            if($cal) {
                $search = ["bulan"," "];
                $bulan = str_replace($search,"",$req['lama_sewa']);
                $hasil = (int)$req['payment'] * $bulan;

                $virtual_acc = [
                    'saldo' => $virtual->saldo - $hasil
                ];
                $cc = VirtualAccount::find($virtual->id);
                $cc->update($virtual_acc);

                $boss = VirtualAccount::where('code_virtual','=','2022080819972')->first();
                $calcu = (int) $boss->saldo + $hasil;
                VirtualAccount::where('code_virtual','=','2022080819972')
                    ->update([
                        'saldo' => $calcu
                    ]);

                if($cc) {
                    $inputLog = [
                        'id_users' => Auth::user()->id,
                        'id_room_kosans' => $req['id'],
                        'id_virtual_accounts' => $cc->id,
                        'id_info_pembayaran' => $cal->id,
                        'id_kontrak_sewas' => $success->id,
                        'status' => 'Pembayaran '.''.$req['lama_sewa'],
                        'total_pembayaran' => $hasil,
                    ];
                    LogPembayaran::firstOrCreate($inputLog);
                }
            }
        }

        return response()->json([
            'status' => 'ok',
            'messages' => 'Success pembayaran sewa kosa kosan.',
            'route' => route('home')
        ],200);

    }


    public function dataTablesPria(Request $request) {
        $data = RoomKosan::with('file','fasilitas','is_type')->where('type','=',2);
        return datatables($data)
            ->addColumn('image',function ($q){
                $val = $q->file->file_kosan;
                $val = asset('uploads/file_kosan') . '/' . $val;
                return $val;
            })
            ->make(true);
    }

    public function dataTablesWanita(Request $request) {
        $data = RoomKosan::with('file','fasilitas','is_type')->where('type','=',3);
        return datatables($data)
            ->addColumn('image',function ($q){
                $val = $q->file->file_kosan;
                $val = asset('uploads/file_kosan') . '/' . $val;
                return $val;
            })
            ->make(true);
    }

    public function dataTablesCampur(Request $request) {
        $data = RoomKosan::with('file','fasilitas','is_type')->where('type','=',1);
        return datatables($data)
            ->addColumn('image',function ($q){
                $val = $q->file->file_kosan;
                $val = asset('uploads/file_kosan') . '/' . $val;
                return $val;
            })
            ->make(true);
    }

    public function uploadFileKosan(UploadedFile $file)
    {
        $destinationPath = public_path() . '/uploads/file_kosan/';
        $extension = $file->getClientOriginalExtension() ?: 'png';
        $fileName = $file->getClientOriginalName();
        return $file->move($destinationPath, $fileName);
    }

    public function downloadKosan($id) {
        $file = FileKosan::where('id_room_kosans', $id)->firstOrFail();
        $pathToFile = public_path() . '/uploads/file_kosan/' . $file->file_kosan;
        return response()->download($pathToFile);
    }
}
