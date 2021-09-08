<?php

namespace App\Http\Controllers;

use App\Models\ActivationVendor;
use App\Models\FileKosan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ActivationVendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.register_vendor');
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
        $req = $request->all();
        $validator = Validator::make($req,[
            'name' => ['required', 'string', 'max:255'],
            'no_hp' => ['required','max:15'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'name_kosan' => ['required', 'string', 'max:255'],
            'no_hp_kosan' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'reason' => ['required', 'string', 'max:255'],
            'file_pendukung' => ['required', 'file', 'max:20000','mimes:pdf'],
            'password' => [
                'required',
                'confirmed',
                'string',
                'min:8',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                ]
        ]);

        if($req['password'] !== $req['password_confirmation'] && $req['password_confirmation'] != null) {
            return response()->json([
                'status' => 'fail',
                'messages' => 'Password anda tidak sama.'
            ],422);
        }

        if($validator->fails()) {
            return response()->json([
                'status' => 'fail',
                'messages' => $validator->errors()->first()
            ],422);
        }
        if ($request->hasFile('file_pendukung')) {
            $inputUser = [
                'name' => $req['name'],
                'no_hp' => $req['no_hp'],
                'email' => $req['email'],
                'password' => Hash::make($req['password']),
//            'password' => Hash::make('pEnd4ing01@'),
            ];
            $user = User::firstOrCreate($inputUser);
            $user->assignRole('visitor');

            $file = $request->file('file_pendukung');
            $file = $this->uploadFilePendukung($file);

            $inputVendor = [
                'name_kosan' => $req['name_kosan'],
                'no_hp_kosan' => $req['no_hp_kosan'],
                'address' => $req['address'],
                'reason' => $req['reason'],
                'file_pendukung' => $file->getFileInfo()->getFilename(),
                'id_users' => $user->id,
            ];

            ActivationVendor::firstOrCreate($inputVendor);
        }

        return response()->json([
            'status' => 'ok',
            'messages' => 'Success register vendor.',
            'route' => route('home')
        ]);
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

    public function uploadFilePendukung(UploadedFile $file)
    {
        $destinationPath = public_path() . '/uploads/file_vendor/';
        $extension = $file->getClientOriginalExtension() ?: 'png';
        $fileName = $file->getClientOriginalName();
        return $file->move($destinationPath, $fileName);
    }
}
