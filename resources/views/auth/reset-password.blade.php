@extends('auth.layout.app')
@section('title', 'Ubah Password')
@section('content')
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100 p-t-62 p-b-33">
                <div class="img text-center">
                    <img src="{{ asset('assets/img/icon_panjang.png') }}" alt="">
                </div>
                <form action="{{ route('password.update') }}" method="POST"
                    class="login100-form p-l-35 p-r-35 p-t-20 p-b-20 validate-form flex-sb flex-w">
                    @csrf
                    <div class="p-t-13 p-b-9">
                        <span class="txt1">
                            New Password
                        </span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input type="hidden" value="{{ request()->token }}" name="token">
                        <input type="hidden" value="{{ request()->email }}" name="email">
                        <input class="input100" type="password" name="password">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="p-t-13 p-b-9">
                        <span class="txt1">
                            Password Confirmed
                        </span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="password_confirmation">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="container-login100-form-btn m-t-17">
                        <button class="login100-form-btn">
                            UBAH PASSWORD
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
