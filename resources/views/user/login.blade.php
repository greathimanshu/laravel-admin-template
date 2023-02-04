@extends('layouts.session')
@section('title', 'Login')
@section('content')
    <div class="content-wrapper">
        <div class="content-inner">
             <div class="content d-flex justify-content-center align-items-center">
                <form id="admin-login-form" class="login-form" action="{{ route('login-user') }}" method="post" autocomplete="off">
                    @csrf
                    <div class="card mb-0 login_box">
                        <div class="card-body" >
                            <div class="text-center mb-3">
                                <img src="{{ asset('merchant/logo/logo2.png') }}" width="100" style="border-radius:0%" />
                                <h5 class="mb-0 sp-des" style="color: black;">Login</h5>
                            </div>
                            @include('success-error')
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="email" id="email" name="email" class="form-control" placeholder="Email"
                                    autocomplete="off">
                            </div>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="password" id="password" name="password" class="form-control"
                                    placeholder="Password">
                                    
                            </div>
                            <span>Forgot <a class="psw" href="{{ route('forgot-password') }}">password?</a></span>
                            
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary btn-block session-btn mb-2">Log in</button>
                                <span class="mt-4 ">Don't have a account? Click here to <a class="psw" href="{{ route('register') }}">register</a></span>
                                
                            </div>
                        </div>
                    </div>
                </form>
            </div> 
          </div>
    </div>
@endsection
@section('page_script')
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $("#email").val("");
                $("#password").val("");
            }, 500)
            $("#admin-login-form").validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                    },
                    password: {
                        required: true,
                    },
                },
                message: {
                    email: 'Email field is required',
                    password: 'Password field is required',
                },
                errorElement: 'span',
                errorClass: 'error text-danger',
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
@endsection
@section('page_style')
    <style>
    </style>
@endsection
