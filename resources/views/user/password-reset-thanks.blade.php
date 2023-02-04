@extends('layouts.session')
@section('content')
    <div class="content-wrapper">
        <div class="content-inner">
            <div class="content d-flex justify-content-center align-items-center">
                <form id="admin-login-form" class="login-form" action="{{ route('user-login') }}" method="post">
                    @csrf
                    <div class="card mb-0 login_box">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <img src="{{ asset('merchant/logo/logo.png') }}" width="100">
                                <h5 class="mb-0 sp-des" style="color:black;">Password changed sucessfully!!</h5>
                                <span class="d-block">Please login with new password to continue.</span>
                                <p class="text-center"><a href="{{ route('user-login') }}">Go back to login!</a></p>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('page_script')
    <script></script>
@endsection
@section('page_style')
    <style>
    </style>
@endsection
