@extends('layouts.admin')

@section('title', 'Data - User')

@section('header')
    <h1>Data User</h1>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4>Tambah User</h4>
          <div class="card-header-action">
            <a href="{{ route('user.index') }}" class="btn btn-primary"><i class="fas fa-chevron-left"></i> Kembali</a>
          </div>
        </div>
        <div class="card-body">
            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="{{ route('user.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="name">Nama User</label>
                        <input id="name" class="form-control" type="text" placeholder="Masukkan Nama User" name="name" value="{{ $user->name }}" required maxlength="64">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input id="email" class="form-control" type="email" placeholder="Masukkan Email" name="email" value="{{ $user->email }}" required maxlength="64">
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" class="form-control" type="password" placeholder="Masukkan password" name="password" maxlength="64">
                </div>

                <div class="form-group form-check">
                    <input class="form-check-input" id="showpw" type="checkbox" onclick="showPw()"/>
                    <label class="form-check-label" for="showpw">Show Password</label>
                </div>

                <div class="form-group">
                    <button class="btn btn-warning btn-sm" type="submit">Perbarui</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('script')
    <script>
        function showPw() {
            var x = document.getElementById('password')
            if(x.type === 'password')
            {
                x.type = 'text'
            }else
            {
                x.type = 'password'
            }
        }
    </script>
@endpush
