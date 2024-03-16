@extends('auth.layout.app')
@section('title', 'Login')
@section('content')
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100 p-t-62 p-b-33">
                <div class="img text-center">
                    <img src="{{ asset('assets/img/icon_panjang.png') }}" alt="">
                </div>
                <form action="{{ route('password.email') }}" method="POST"
                    class="login100-form p-l-35 p-r-35 p-b-10 validate-form flex-sb flex-w">
                    @csrf
                    <div class="p-t-31 p-b-9">
                        <span class="txt1">
                            Masukkan Email Anda
                        </span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Username is required">
                        <input class="input100" type="email" name="email">
                        <span class="focus-input100"></span>
                    </div>
                    <div class="container-login100-form-btn m-t-17">
                        <button class="login100-form-btn">
                            KIRIM EMAIL
                        </button>
                    </div>
                    <div class="w-full text-center p-t-10">
                        <a href="{{ route('login') }}" type="button" class="txt2 bo1">
                            Login
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
