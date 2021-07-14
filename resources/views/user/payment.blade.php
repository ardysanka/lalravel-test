@extends('layouts.app')

@section('content')
<style>
    .borderless td, .borderless th {
    border: none;
}
</style>
    <div class="container">
        <div class="col-md-4 offset-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Pay Your Order</h3>
                </div>
                <form action="{{ route('user.payment.pay',$order->id) }}" method="post">
                @csrf
                    <div class="card-body">
                        <x-form.input name='Order Number' id="orderNumber" type="Text" value="{{$order->order_number}}"  readonly="true"/>
                                              
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-block">Pay Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection