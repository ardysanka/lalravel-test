@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-4 offset-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Login</h3>
                </div>
                <form action="{{ route('user.login.process') }}" method="post">
                @csrf
                    <div class="card-body">
                        {{-- <x-form.input name="Name" id="name" placeholder="Full Name" /> --}}
                        <x-form.input name="Email" id="email" placeholder="Email" />
                        <x-form.input name="Password" id="password" type="password" placeholder="Password" />
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection