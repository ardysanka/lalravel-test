@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-4 offset-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Product Page</h3>
                </div>
                <form action="{{ route('user.product-order.process') }}" method="post">
                @csrf
                    <div class="card-body">
                        @if(session('errors'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                Something it's wrong:
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                            </div>
                        @endif
                        <x-form.input name="Produt" id="product" placeholder="Input Product" />
                        <x-form.input name="Address" id="address" placeholder="Input Address" />
                        <x-form.input name="Price" id="price" placeholder="Input Price" />
                        
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection