@extends('layouts.app')

@section('content')

            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Register</h3>
                </div>
                <form action="{{ route('user.register.process') }}" method="post">
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
                        <x-form.input name="Name" id="name" placeholder="Full Name" />
                        <x-form.input name="Email" id="email" placeholder="Email" />
                        <x-form.input name="Password" id="password" type="password" placeholder="Password" />
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                </form>
            </div>
@endsection