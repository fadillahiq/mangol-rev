@extends('layouts.resetpassword')

@section('content')
<div class="card-header"><h4>Reset Password</h4></div>

<div class="card-body">
  <p class="text-muted">We will send a link to reset your password</p>
  <form method="POST" action="{{ route('password.update') }}">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">

    <div class="form-group">
      <label for="email">Email</label>
      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" tabindex="1" required autocomplete="email" autofocus>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
      <label for="password">New Password</label>
      <input id="password" type="password" class="form-control pwstrength @error('password') is-invalid @enderror" data-indicator="pwindicator" tabindex="2" name="password" required autocomplete="new-password">
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      <div id="pwindicator" class="pwindicator">
        <div class="bar"></div>
        <div class="label"></div>
      </div>
    </div>

    <div class="form-group">
      <label for="password-confirm">Confirm Password</label>
      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" tabindex="2" required autocomplete="new-password">
    </div>

    <div class="form-group">
      <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
        Reset Password
      </button>
    </div>
  </form>
</div>
@endsection
