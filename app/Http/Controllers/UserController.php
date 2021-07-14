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
                'name.required'     => 'Full Name Required',
                'name.min'          => 'Full Name minimal 3 karakter',
                'name.max'          => 'Full Name Maximal 35 karakter',
                'email.required'    => 'Email Required',
                'email.email'       => 'Email Invalid',
                'email.unique'      => 'Email Already Registered',
                'password.required' => 'Password Required',
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
            $notifType = 'notifSuccess';
            $notifMessage = 'Now You Can login';
            return redirect()->route('login')->with(compact('notifType', 'notifMessage'));
        } catch (\Throwable $th) {
            DB::rollBack();
            // dd($th->getMessage());
            // $this->alert('error', $th->getMessage());
              $notifType = "notifError";
            $notifMessage = $th->getMessage();
             return redirect()->back()->withInput()->with(compact('notifType', 'notifMessage'))
             ->with([$notifType => $notifMessage]);
        }
    }

    public function login(Request $request)
    {
        DB::beginTransaction();
        try {
            $rules = [
                'email'                 => 'required|email',
                'password'              => 'required|min:6'
            ];

            $messages = [
                'email.required'        => 'Email Required',
                'email.email'           => 'Email Invalid',
                'password.required'     => 'Password Required',
                'password.min'          => 'Password Min 6 Character',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput($request->all);
            }

            $data = [
                'email'     => $request->input('email'),
                'password'  => $request->input('password'),
            ];

            Auth::attempt($data);

            if (Auth::check()) {
                return redirect()->route('home');
            } else {
                $notifType = 'notifError';
                $notifMessage = 'Invalid Username Or Password';
                return redirect()->back()->withInput($request->all)->with(compact('notifType', 'notifMessage'));
            }
            DB::commit();
            return "Success";
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
            // $this->alert('error', $th->getMessage());
              $notifType = "notifError";
            $notifMessage = $th->getMessage();
             return redirect()->back()->withInput()->with(compact('notifType', 'notifMessage'))
             ->with([$notifType => $notifMessage]);
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
