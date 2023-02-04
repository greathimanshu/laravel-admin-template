@extends('layouts.session')
@section('title', 'Login')
@section('content')
<div class="content-wrapper">
  <div class="content-inner">
    <div class="content d-flex justify-content-center align-items-center">
      <form id="admin-login-form" class="login-form" action={{ route('register-user') }} method="post" autocomplete="off">
        @csrf
        <div class="card mb-0 login_box">
          <div class="card-body">
            <div class="text-center mb-3">
              <img src="{{ asset('merchant/logo/logo2.png') }}" width="100" style="border-radius:0%" />
              <h5 class="mb-0 sp-des" style="color: black;">  
                Register User
              </h5>
            </div>
            @include('success-error')
            <div class="form-outline mb-4">
              <label for="exampleInputPassword1" class="form-label"> Full Name</label>
              <input type="text" id="form2Example11" name="fullname" class="form-control" placeholder="Full name" />
              @if($errors->has('fullname'))
              <p class="text-danger">
                {{ $errors->first('fullname');}}
              </p>
              @endif
            </div>

            <div class="form-outline mb-4">
              <label for="exampleInputEmail1" class="form-label">Email address</label>
              <input type="email" id="form2Example11" name="email" class="form-control" placeholder="Email" />
              @if($errors->has('email'))
              <p class="text-danger">
                {{ $errors->first('email');}}
              </p>
              @endif
            </div>

            <div class="form-outline mb-4">
              <label for="exampleInputPassword1" class="form-label">Enter Password</label>
              <input type="password" id="form2Example11" name="password" class="form-control" placeholder="Password" />
              @if($errors->has('password'))
              <p class="text-danger">
                {{ $errors->first('password');}}
              </p>
              @endif

            </div>

            <div class="form-outline mb-4">
              <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
              <input type="password" id="form2Example22" name="confirm_password" class="form-control" placeholder=" Confirme Password" />
              @if($errors->has('confirm_password'))
              <p class="text-danger">
                {{ $errors->first('confirm_password');}}
              </p>
              @endif
            </div>

            <div class="form-group mt-4">
              <button type="submit" class="btn btn-primary btn-block session-btn mb-2">Sign in</button>
              <span>Already have a account? Click here to <a class="psw" href="{{ route('user-login') }}">Login</a></span>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection