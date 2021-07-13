@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-4 offset-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Prepaid Balance</h3>
                </div>
                <form action="{{ route('user.prepaid-balance.process') }}" method="post">
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
                        <x-form.input name="Phone Number" id="phone" placeholder="Input Phone Number" />
                        <x-form.input name="Total" id="total" placeholder="Value" />
                        
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection