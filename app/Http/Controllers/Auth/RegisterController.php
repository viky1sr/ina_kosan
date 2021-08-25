<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $alert = [
            'name.required'=> 'Name belum terisi, Silakan isi terlebih dahulu ',
            'email.required'=> 'Email belum terisi, Silakan isi terlebih dahulu ',
            'email.unique'=> sprintf("Email sudah terdaftar %s",  $data['email']),
            'password.required' => "Password belum terisi, Silakan isi terlebih dahulu",
            'password.min' => "Password harus 8 karakter",
            'password.confirmed' => "Password Confirmation belum terisi, Silakan isi terlebih dahulu",
            'password.regex' => "Password harus mengunakan angka dan terdatapat kapital"
        ];

        if($data['password'] !== $data['password_confirmation']) {
            $alert = [
                'password.confirmed' => "Password anda tidak sama",
            ];
        }

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'no_hp' => ['required','max:15'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => [
                'required',
                'confirmed',
                'string',
                'min:8',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
            ]
        ],$alert);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user =  User::create([
            'name' => $data['name'],
            'no_hp' => $data['no_hp'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->assignRole('visitor');

        return $user;
    }
}
