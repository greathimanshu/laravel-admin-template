@extends('layouts.session')
@section('title', 'Forgot Password')

@section('content')
    <div class="content-wrapper">
        <div class="content-inner">
            <div class="content d-flex justify-content-center align-items-center">
                <form id="admin-login-form" class="login-form" action="{{ route('send-forgot-password') }}" method="post"
                    autocomplete="off">
                    @csrf
                    <div class="card mb-0 login_box">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <img src="{{ asset('merchant/logo/logo.png') }}" width="100"style="border-radius:10%" />
                                <h5 class="mb-0 sp-des" style="color:black;">Forgot Password</h5>
                            </div>
                            @include('success-error')
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="email" id="email" name="email" class="form-control" placeholder="Email"
                                    autocomplete="off">
                            </div>
                            <p class="text-right"><a href="{{ route('user-login') }}">Go back to login!</a></p>
                            <div class="form-group mt-45">
                                <button type="submit" class="btn btn-primary btn-block session-btn">Submit</button>
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
