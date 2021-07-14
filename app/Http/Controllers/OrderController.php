<?php

namespace App\Http\Controllers;

use App\Jobs\CancelPayment;
use App\Models\Order;
use App\Models\PrepaidBalance;
use App\Models\ProductOrder;
use App\Rules\PhoneNumber;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View ;
use Symfony\Component\HttpFoundation\Session\Session;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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

            $phone =  $request->get('phone');
            $prepaidBalance = new PrepaidBalance();
            $prepaidBalance->mobile_number = $phone;
            $prepaidBalance->value = $request->get('total');
            $prepaidBalance->save();

            $order = new Order();
            $order->user_id = Auth::user()->id;
            $order->order_number = rand(1111111111, 9999999999);
            $order->order_status_id = 5;
            $order->total = ($request->get('total') * 0.05) + $request->get('total');
            $prepaidBalance->order()->save($order);

            $job = new CancelPayment($order);
            $job->delay(now()->addMinutes(5));
            dispatch($job);

            DB::commit();
            $message = "Your mobile phone number $phone will
            receive Rp $order->total";
            $notifType = 'notifSuccess';
            $notifMessage = 'Order Success';
            return View::make('user.success')
            ->with(compact('message', 'order', 'notifType', 'notifMessage'));
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

    public function createProductOrder(Request $request)
    {
        DB::beginTransaction();
        try {
            $rules = [
                'product'   => ['required', 'min:10', 'max:150'],
                'address'   => ['required', 'min:10', 'max:150'],
                'price'     => ['required','numeric'],
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput($request->all);
            }

            $prepaidBalance = new ProductOrder();
            $prepaidBalance->product = $request->get('product');
            $prepaidBalance->address = $request->get('address');
            $prepaidBalance->total = $request->get('price');
            $prepaidBalance->save();

            $order = new Order();
            $order->user_id =  Auth::user()->id;
            $order->order_number = rand(1111111111, 9999999999);
            $order->order_status_id = 5;
            $order->total = $request->get('price') + 10000;
            $prepaidBalance->order()->save($order);

            $job = new CancelPayment($order);
            $job->delay(now()->addMinutes(5));
            dispatch($job);

            DB::commit();
            $message = "$prepaidBalance->product that costs $order->total will be
            shipped to :
            $prepaidBalance->address
            only after you pay";
            $notifType = 'notifSuccess';
            $notifMessage = 'Order Success';
            return View::make('user.success')
            ->with(compact('message', 'order', 'notifType', 'notifMessage'));
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

    public function payment($id)
    {
        DB::beginTransaction();
        try {
            // $order = Order::find($id)->whereNotIn('order_status_id', array('4', '3'));
            $status = "";
            $xstatus = "";
            $order = Order::where('user_id', Auth::user()->id)->find($id);
            if ($order) {
                if ($order->order_status_id == 5) {
                    $mytime = Carbon::now();
                    if (
                        $mytime->format('H:i') >= Carbon::createFromFormat('H:i', '05:00') &&
                        $mytime->format('H:i') <= Carbon::createFromFormat('H:i', '06:00')
                    ) {
                        $p = rand(0, 99);
                        if ($p < 90) {
                            $xstatus = 3;
                            $p = rand(0, 99);
                            if ($p < 40) {
                                $xstatus = 1;
                            }
                        } else {
                            $xstatus = 1;
                        }
                    } else {
                        $xstatus = 3;
                    }
                    $order->update([
                        'order_status_id' => $xstatus
                    ]);
                    if ($xstatus == 1) {
                        $status = "failed";
                    } elseif ($xstatus == 3) {
                        $status = "success";
                    }
                } elseif ($order->order_status_id == 4) {
                    $status = "cancelled";
                }
            } else {
                $status = "notfound";
            }
            DB::commit();
            switch ($status) {
                case 'success':
                    $notifType = "notifSuccess";
                    $notifMessage = "Your Payment Accepted";
                    break;
                case 'cancelled':
                    $notifType = "notifWarning";
                    $notifMessage = "Your Payment already Cancelled";
                    break;
                case 'notfound':
                    $notifType = "notifError";
                    $notifMessage = "Your order not found";
                    break;
                case 'failed':
                    $notifType = "notifError";
                    $notifMessage = "Payment is Failed";
                    break;
                default:
                    $notifType = "notifError";
                    $notifMessage = "There is something Happend";
                    break;
            }

            return redirect()->route('user.order.history')->with(compact('notifType', 'notifMessage'))
            ->with([$notifType => $notifMessage]);
        } catch (\Throwable $th) {
            DB::rollBack();
            $notifType = "notifError";
            $notifMessage = $th->getMessage();
             return redirect()->back()->withInput()->with(compact('notifType', 'notifMessage'))
             ->with([$notifType => $notifMessage]);
        }
    }
}
