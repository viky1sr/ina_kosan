<?php

namespace App\Http\Controllers;

use App\Models\KontrakSewa;
use Illuminate\Http\Request;
use Auth;

class MyKosanController extends Controller
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
    public function index()
    {
        $array = [
            'title' => 'My',
            'title_header' => 'Kos Kosan'
        ];
        return view('pages.kos_kosan.my_kosan',$array);
    }

    public function applyKosan(Request $request, $id){
        $req = $request->all();

        if($req['status'] == null) {
            return response()->json([
                'status' => 'fail',
                'messages' => 'Please select status'
            ],422);
        }
        KontrakSewa::find($id)->update([
           'status' => $req['status']
        ]);
        return response()->json([
            'status' => 'ok',
            'messages' => 'Success update status'
        ],200);
    }

    public function dataTable(Request $request) {
        if(Auth::user()->hasRole('member')){
            $data = KontrakSewa::with('kosan','bukti_tf')->where('id_users','=',Auth::user()->id);
        } else if(Auth::user()->hasRole('vendor')) {
            $data = KontrakSewa::with('kosan','bukti_tf')
                ->whereHas('kosan', function ($q){
                    $q->where('id_pemilik','=',Auth::user()->id);
                });
        } else {
            $data = KontrakSewa::with('kosan','bukti_tf');
        }
        return datatables($data)
            ->addColumn('image', function($q){
                $val = $q->bukti_tf->bukti_transfer;
                $val = asset('uploads/file_transfer') . '/' . $val;
                return $val;
            })
            ->addIndexColumn(['image'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
}
