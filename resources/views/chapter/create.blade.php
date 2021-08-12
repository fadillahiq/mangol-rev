@extends('layouts.admin')

@section('title', 'Data - Chapter')

@section('header')
    <h1>Data Chapter</h1>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4>Tambah Chapter</h4>
          <div class="card-header-action">
            <a href="{{ route('chapters.index') }}" class="btn btn-primary"><i class="fas fa-chevron-left"></i> Kembali</a>
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
            @if ($message = Session::get('error'))
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @endif
            <form action="{{ route('chapters.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="name">Nama Chapter</label>
                        <input id="name" class="form-control" type="text" placeholder="Masukkan Nama Chapter" name="name" value="{{ old('name') }}" required maxlength="20">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="comic_id">Komik</label>
                        <select class="form-control select2" name="comic_id" id="comic_id" required>
                            <option value="" selected disabled>Pilih Komik</option>
                            @foreach ($comics as $comic)
                                <option value="{{ $comic->id }}">{{ $comic->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="form-control" name="content" id="content" cols="30" rows="10" required>{{ old('content') }}</textarea>
                </div>

                <div class="form-group">
                    <button class="btn btn-success btn-sm" type="submit">Simpan</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('script')
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script>
    var options = {
      filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
      filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
      filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
      filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    };
    </script>
    <script>
        CKEDITOR.replace('content', options);
    </script>
@endpush
