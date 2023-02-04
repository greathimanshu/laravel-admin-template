@extends('layouts.session')
@section('content')
    <div class="content-wrapper">
        <div class="content-inner">
            <div class="content d-flex justify-content-center align-items-center">
                <form id="reset-password-form" method="POST" class="login-form" action="{{ route('password-reset-update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $data['token'] }}">
                    <input type="hidden" name="email" class="form-control" value="{{ $data['email'] ?? old('email') }}"
                        readonly>
                    <div class="card mb-0 login_box">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <img src="{{ asset('merchant/logo/logo.png') }}" width="100">
                                <h5 class="mb-0 sp-des">Reset Password</h5>
                            </div>

                            @include('success-error')
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="password" id="password" name="password" class="form-control show-password-sd"
                                    placeholder="Password" required>
                                <div style="margin-top: 3px;">
                                    <span>
                                        <input type="checkbox" class="show-password-checkbox">
                                    </span>
                                    <span style="margin-left: 3px;">Show Password</span>
                                </div>
                            </div>

                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="password" id="password-confirm" name="password_confirmation"
                                    class="form-control show-password-sd" placeholder="Confirm Password" required>
                                <div style="margin-top: 3px;">
                                    <span>
                                        <input type="checkbox" class="show-password-checkbox">
                                    </span>
                                    <span style="margin-left: 3px;">Show Password</span>
                                </div>
                            </div>

                            <div class="form-group">
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
            // $.validator.addMethod("strong_password", function(value, element) {
            //     let password = value;
            //     if (!(/^(?=.*[A-Za-z])(?=.*[0-9])(.{8,50}$)/.test(password))) {
            //         return false;
            //     }
            //     return true;
            // }, function(value, element) {
            //     let password = $(element).val();
            //     if (!(/^(?=.*[A-Za-z])(?=.*[0-9])(.{8,50}$)/.test(password))) {
            //         return 'Password should be at least 8 characters and a combination of letters and digits.';
            //     }
            //     return false;
            // });

            $('#reset-password-form').validate({
                rules: {
                    password: {
                        required: true,
                        strong_password: true,
                    },
                    password_confirmation: {
                        required: true,
                        strong_password: true,
                        equalTo: "#password"
                    },
                },
                messages: {},
                errorClass: 'text-danger',
                errorPlacement: function(error, element) {
                    if (element.attr("name") == "file[]")
                        error.insertAfter(".custom-file-res");
                    else
                        error.insertAfter(element);
                }
            });
            $(".show-password-checkbox").on("change", function() {
                var x = $(this).parent("span").parent("div").siblings(".show-password-sd");
                if ($(x).attr("type") === "password") {
                    $(x).attr("type", "text")
                } else {
                    $(x).attr("type", "password")
                }
            });
        });
    </script>
@endsection
@section('page_style')
    <style>
    </style>
@endsection
