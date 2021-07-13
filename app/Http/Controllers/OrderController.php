<?php

namespace App\Http\Controllers;

use App\Jobs\CancelPayment;
use App\Models\Order;
use App\Models\PrepaidBalance;
use App\Rules\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        DB::beginTransaction();
        try {
            $rules = [
                'phone' => ['required', new PhoneNumber(),
                    'min:3', 'max:35'],
                'total' => 'required',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput($request->all);
            }

            $prepaidBalance = new PrepaidBalance();
            $prepaidBalance->mobile_number = $request->get('phone');
            $prepaidBalance->value = $request->get('total');
            $prepaidBalance->save();

            $order = new Order();
            $order->user_id = 1;
            $order->order_status_id = 5;
            $order->total = ($request->get('total') * 0.05) + $request->get('total');
            $prepaidBalance->order()->save($order);

            $job = new CancelPayment($order);
            $job->delay(now()->addMinutes(5));
            dispatch($job);

            DB::commit();
            return "Success";
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
            // $this->alert('error', $th->getMessage());
            // return redirect()->back()->withInput();
        }
    }
}
