@extends('layouts.app')

@section('css')
<style>
    .borderless td, .borderless th {
    border: none;
}
</style>
@endsection

@section('content')


            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Success</h3>
                </div>

                @csrf
                    <div class="card-body">
                        <table class="table borderless" style="border: none !important;">
                            <tr>
                                <td><x-form.label value="Order No" /></td>
                                <td><x-form.label value="{{$order->order_number}}" /></td>
                            </tr>
                            <tr>
                                <td><x-form.label value="Total" /></td>
                                <td><x-form.label value="{{$order->total}}" /></td>
                            </tr>
                        </table>
                        <p>
                            {{$message}}
                        </p>                        
                    </div>
                    <div class="card-footer">
                        <a href="{{route('user.payment.view',$order->id)}}" class="btn btn-primary btn-block">Pay Now</a>
                    </div>

            </div>

@endsection