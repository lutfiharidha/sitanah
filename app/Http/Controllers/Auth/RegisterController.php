<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Auth;
use App\Penjual;
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
    protected $redirectTo = '/penjual/dashboard';

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
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = New User;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->save();

        $fotoKtp = $data['fotoKtp'];
        $nameKtp = rand(3000,999999).$fotoKtp->getClientOriginalName();
        $destinationPath = public_path().'/img/ktp/';
        $fotoKtp->move($destinationPath,$nameKtp);

        $addressInfo = $data['kecamatan'];
        $addressArray = explode(',', $addressInfo);
        $penjual = new Penjual;
        $penjual->user_id = $user->id;
        $penjual->kota = $addressArray[0];
        $penjual->kecamatan = $addressArray[1];
        $penjual->alamat = $data['alamat'];
        $penjual->no_telp = $data['noHp'];
        $penjual->ktp = $data['noKtp'];
        $penjual->foto_ktp = $nameKtp;
        $penjual->save();

        return $user;
    }
}
