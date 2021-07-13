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
          <h4>Ubah Chapter</h4>
          <div class="card-header-action">
            <a href="{{ route('chapter.index') }}" class="btn btn-primary"><i class="fas fa-chevron-left"></i> Kembali</a>
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
            <form action="{{ route('chapter.update', $chapter->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="name">Nama Chapter</label>
                        <input id="name" class="form-control" type="text" placeholder="Masukkan Nama Chapter" name="name" value="{{ $chapter->name }}" required maxlength="20">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="comic_id">Komik</label>
                        <select class="form-control select2" name="comic_id" id="comic_id" required>
                            @foreach ($comics as $comic)
                                <option value="{{ $comic->id }}" @if($comic->id == $chapter->comic_id) selected @endif>{{ $comic->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="form-control" name="content" id="content" cols="30" rows="10" required>{!! $chapter->content !!}</textarea>
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
