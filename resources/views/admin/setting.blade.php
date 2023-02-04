@extends('layouts.admin.master')
@section('title', 'Setting')

@section('content')
    <!-- Main content -->
    <div class="content-wrapper">
        <div class="content-inner">
            <div class="page-header page-header-light changeTitle">
                <div class="page-header-content header-elements-lg-inline">
                    <div class="page-title d-flex">
                        <h4> <span class="font-weight-semibold">{{ $data['page_title'] ?? 'Dashboard' }}</span></h4>
                        <a href="#" class="header-elements-toggle text-body d-lg-none"><i class="icon-more"></i></a>
                    </div>
                </div>
            </div>

            <div class="content changeBody">
                @include('success-error')
                <div class="row">
                    <div class="col-lg-6">
                        {{-- ******************************************************* Change Password ******************************************************* --}}
                        <div class="card changeTable">
                            <div class="card-header">
                                <h6 class="card-title">Change Password</h6>
                            </div>
                            <div class="card-body">
                                <form id="change-password-form" action="{{ route('settings') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="request_type" value="change_password">
                                    <div class="form-group">
                                        <label>Current Password:</label>
                                        <input type="password" name="old_password" class="form-control show-password-sd"
                                            placeholder="Current Password" required>
                                        <div style="margin-top: 3px;">
                                            <span>
                                                <input type="checkbox" class="show-password-checkbox">
                                            </span>
                                            <span style="margin-left: 3px;">Show Password</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>New Password:</label>
                                        <input type="password" id="password" name="password"
                                            class="form-control show-password-sd" placeholder="New Password" required>
                                        <div style="margin-top: 3px;">
                                            <span>
                                                <input type="checkbox" class="show-password-checkbox">
                                            </span>
                                            <span style="margin-left: 3px;">Show Password</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm Password:</label>
                                        <input type="password" name="password_confirmation"
                                            class="form-control show-password-sd" placeholder="Confirm Password" required>
                                        <div style="margin-top: 3px;">
                                            <span>
                                                <input type="checkbox" class="show-password-checkbox">
                                            </span>
                                            <span style="margin-left: 3px;">Show Password</span>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-start align-items-center">
                                        <button type="submit" class="btn btn-primary">Submit <i
                                                class="icon-paperplane ml-2"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        {{-- ******************************************************* Personal Detail ******************************************************* --}}
                        <div class="card changeTable">
                            <div class="card-header">
                                <h6 class="card-title">Personal Detail</h6>
                            </div>
                            <div class="card-body">
                                <form id="personal_detail" action="{{ route('update.profile.admin') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="request_type" value="smtp">
                                    @php
                                        $smtp = $settings->smtp ?? null;
                                    @endphp
                                    <div class="form-group">
                                        <label>Name:</label>
                                        <input type="text" name="name" class="form-control" placeholder="Name"
                                            value="{{ \Auth::user()->name ?? '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Email:</label>
                                        <input type="email" name="email" class="form-control" placeholder="Email"
                                            value="{{ \Auth::user()->email ?? '' }}">
                                    </div>

                                    <div class="d-flex justify-content-start align-items-center">
                                        <button type="submit" class="btn btn-primary">Submit <i
                                                class="icon-paperplane ml-2"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('page_script')
    <script src="{{ asset('/admin/plugins/selectize.js/dist/js/selectize.min.js') }}"></script>
    <script>
        $("#input-tags").selectize({
            delimiter: ",",
            persist: false,
            create: function(input) {
                return {
                    value: input,
                    text: input,
                };
            },
        });
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

            $("#change-password-form").validate({
                rules: {
                    old_password: {
                        required: true,
                    },
                    password: {
                        required: true,
                        strong_password: true,
                        minlength: 6,
                        maxlength: 32,
                    },
                    password_confirmation: {
                        required: true,
                        strong_password: true,
                        equalTo: "#password"
                    },
                },
                message: {

                },
                errorElement: 'span',
                errorClass: 'error text-danger',
                submitHandler: function(form) {
                    form.submit();
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
    <link rel="stylesheet" href="{{ asset('admin/plugins/selectize.js/dist/css/selectize.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/selectize.js/dist/css/selectize.default.css') }}">
    <style>
        .popular-items-chart-wrapper {
            width: 50%;
            float: left;
        }
    </style>
@endsection
