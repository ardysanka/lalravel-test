<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ViewUserController extends Controller
{
    public function registerView()
    {
        return view('register');
    }

    public function login()
    {
        return view('login');
    }

    public function prepaidBalanceView()
    {
        return View('user.prepaid-balance');
    }
}
