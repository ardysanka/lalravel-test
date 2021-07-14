<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function productOrderView()
    {
        return View('user.product-order');
    }

    public function successOrderView()
    {
        return View('user.success');
    }

    public function orderHistoryView(Request $request)
    {

        $order = Order::where('user_id', Auth::user()->id)
        ->when($request->get('search'), function ($query, $search) {
            $query->where('order_number', 'like', '%' . $search . '%');
        })->orderBy('created_at','desc')->paginate(5);
        if ($request->has('search')) {
            $search = $request->get('search');
        } else {
            $search = null;
        }
        return View('user.order-history')->with(compact('order', 'search'));
    }

    public function paymentView($id)
    {
        $order = Order::find($id);
        // dd($order->order_number);
        return View('user.payment')->with(compact('order'));
    }
}
