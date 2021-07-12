@extends('layouts.admin')

@section('title', 'Data - Genre')

@section('header')
    <h1>Data Genre</h1>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4>Ubah Genre</h4>
          <div class="card-header-action">
            <a href="{{ route('genre.index') }}" class="btn btn-primary"><i class="fas fa-chevron-left"></i> Kembali</a>
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
            <form action="{{ route('genre.update', $genre->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Nama Genre</label>
                    <input id="name" class="form-control" type="text" placeholder="Masukkan Nama Genre" name="name" value="{{ $genre->name }}" required maxlength="20">
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
