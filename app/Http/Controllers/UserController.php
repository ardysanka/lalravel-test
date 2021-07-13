<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Session\Session;

class UserController extends Controller
{
    public function register(Request $request)
    {
        DB::beginTransaction();
        try {
            $rules = [
                'name'      => 'required|min:3|max:35',
                'email'     => 'required|email|unique:users,email',
                'password'  => 'required'
            ];
            $messages = [
                'name.required'     => 'Nama Lengkap wajib diisi',
                'name.min'          => 'Nama lengkap minimal 3 karakter',
                'name.max'          => 'Nama lengkap maksimal 35 karakter',
                'email.required'    => 'Email wajib diisi',
                'email.email'       => 'Email tidak valid',
                'email.unique'      => 'Email sudah terdaftar',
                'password.required' => 'Password wajib diisi',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                // dd($validator);
                return redirect()->back()->withErrors($validator)->withInput($request->all);
            }

            $user = new User();
            $user->name = ucwords(strtolower($request->get('name')));
            $user->email = $request->get('email');
            $user->password = Hash::make($request->password);
            $user->save();
            DB::commit();
            return "Success";
        } catch (\Throwable $th) {
            DB::rollBack();
            // dd($th->getMessage());
            $this->alert('error', $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function login(Request $request)
    {
        DB::beginTransaction();
        try {
            $rules = [
                'email'                 => 'required|email',
                'password'              => 'required'
            ];

            $messages = [
                'email.required'        => 'Email wajib diisi',
                'email.email'           => 'Email tidak valid',
                'password.required'     => 'Password wajib diisi',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                dd("validas");
                // return redirect()->back()->withErrors($validator)->withInput($request->all);
            }

            $data = [
                'email'     => $request->input('email'),
                'password'  => $request->input('password'),
            ];

            Auth::attempt($data);

            if (Auth::check()) { // true sekalian session field di users nanti bisa dipanggil via Auth
                //Login Success
                // dd("Berhasil");
                return redirect()->route('home');
            } else { // false
                //Login Fail
                dd("Gagal");
                // Session::flash('error', 'Email atau password salah');
                // return redirect()->route('login');
            }
            DB::commit();
            return "Success";
        } catch (\Throwable $th) {
            DB::rollBack();
            // dd($th->getMessage());
            $this->alert('error', $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function logout()
    {
        Auth::logout(); // menghapus session yang aktif
        return redirect()->route('login');
    }

    public function test() {
        $variable = "0811294123122";
        if (preg_match("/(081)[0-9]*$/", $variable)) {
            dd("berhasil");
        } else {
            dd("gagal");
        }
    }
}
