@extends('layouts.admin.master')
@section('title', 'Add User')

@section('content')
    <!-- Main content -->
    <div class="content-wrapper">
        <div class="content-inner">
            <div class="page-header page-header-light changeTitle">
                <div class="page-header-content header-elements-lg-inline">
                    <div class="page-title d-flex">
                        <h4>
                            <span class="font-weight-semibold">Add User</span>
                        </h4>
                        <a href="#" class="header-elements-toggle text-body d-lg-none"><i class="icon-more"></i></a>
                    </div>

                    <div class="header-elements d-none">
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('users') }}" class="btn btn-primary">
                                <i class="mdi mdi-plus menu-icon"></i>
                                User Listing
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @include('success-error')
            <div class="content changeBody">
                <form action="{{ route('save-user') }}" method="post">
                    @csrf
                    <div class="form-outline mb-4">
                        <label for="exampleInputPassword1" class="form-label"> Full Name</label>
                        <input type="text" id="form2Example11" name="fullname" class="form-control"
                            placeholder="Full name" />
                        @if ($errors->has('fullname'))
                            <p class="text-danger">
                                {{ $errors->first('fullname') }}
                            </p>
                        @endif
                    </div>

                    <div class="form-outline mb-4">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" id="form2Example11" name="email" class="form-control" placeholder="Email" />
                        @if ($errors->has('email'))
                            <p class="text-danger">
                                {{ $errors->first('email') }}
                            </p>
                        @endif
                    </div>

                    <div class="form-outline mb-4">
                        <label for="exampleInputPassword1" class="form-label">Enter Password</label>
                        <input type="password" id="form2Example11" name="password" class="form-control"
                            placeholder="Password" />
                        @if ($errors->has('password'))
                            <p class="text-danger">
                                {{ $errors->first('password') }}
                            </p>
                        @endif

                    </div>

                    <div class="form-outline mb-4">
                        <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                        <input type="password" id="form2Example22" name="confirm_password" class="form-control"
                            placeholder=" Confirme Password" />
                        @if ($errors->has('confirm_password'))
                            <p class="text-danger">
                                {{ $errors->first('confirm_password') }}
                            </p>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('page_style')
    <style>
        .popular-items-chart-wrapper {
            width: 50%;
            float: left;
        }
    </style>
@endsection
