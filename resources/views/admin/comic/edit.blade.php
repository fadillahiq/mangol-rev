@extends('layouts.admin')

@section('title', 'Data - Komik')

@section('header')
    <h1>Data Komik</h1>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4>Ubah Komik</h4>
          <div class="card-header-action">
            <a href="{{ route('komik.index') }}" class="btn btn-primary"><i class="fas fa-chevron-left"></i> Kembali</a>
          </div>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="aler alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('komik.update', $comic->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nama Komik</label>
                    <input id="name" class="form-control" type="text" placeholder="Masukkan Nama Komik" maxlength="255" name="name" value="{{ $comic->name }}" required maxlength="20">
                </div>

               <div class="row">
                <div class="form-group col-md-6">
                    <label for="release">Release</label>
                    <input type="text" class="yearpicker form-control" name="release" value="{{ $comic->release }}" required/>
                </div>

                <div class="form-group col-md-6">
                    <label for="status">Status</label>
                    <select class="form-control select2" name="status" id="status" required>
                        <option value="On Going" @if($comic->status == "On Going") selected @endif>On Going</option>
                        <option value="Completed" @if($comic->status == "Completed") selected @endif>Completed</option>
                    </select>
                </div>
               </div>
               
               <div class="row">
                <div class="form-group col-md-4">
                    <label for="author">Author</label>
                    <input type="text" class="form-control" name="author" value="{{ $comic->author }}" maxlength="50" required/>
                </div>

                <div class="form-group col-md-4">
                    <label for="type">Type</label>
                    <select class="form-control select2" name="type" id="type">
                        <option value="" selected disabled>Pilih Type</option>
                        <option value="Manga" @if($comic->type == "Manga") selected @endif>Manga</option>
                        <option value="Manhwa" @if($comic->type == "Manhwa") selected @endif>Manhwa</option>
                        <option value="Manhua" @if($comic->type == "Manhua") selected @endif>Manhua</option>
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="genre">Genre</label>
                    <select class="form-control select2" id="genre" name="genre[]" multiple="">
                        @foreach ($genres as $genre)
                        <option value="{{ $genre->id }}"
                            @foreach ($comic->genre as $value)
                                @if($genre->id == $value->id) selected @endif
                            @endforeach>{{ $genre->name }}</option>
                        @endforeach
                    </select>
                </div>
               </div>

                <div class="form-group">
                    <label for="sinopsis">Sinopsis</label>
                    <textarea class="form-control" name="sinopsis" id="sinopsis" cols="30" rows="10" required>{{ $comic->sinopsis }}</textarea>
                </div>

                <div class="form-group">
                    <label for=thumbnail">Thumbnail</label>
                    <input class="form-control" type="file" name="thumbnail">
                    {{-- <textarea class="form-control" name="thumbnail" id="my-editor" cols="30" rows="10" required>{{ old('thumbnail') }}</textarea> --}}
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
@push('style')
    <!-- Year Picker CSS -->
    <link rel="stylesheet" href="{{ asset('year-picker/css/yearpicker.css') }}" />
@endpush
@push('script')
<!-- Moment Js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
{{-- <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script> --}}
<script src="{{ asset('year-picker/js/yearpicker.js') }}"></script>
<script>
$(document).ready(function() {
   $(".yearpicker").yearpicker({
      year: 2021,
      startYear: 2000,
      endYear: 2050,
   });
});
</script>
{{-- <script>
    var options = {
      filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
      filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
      filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
      filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    };
</script>
<script>
    CKEDITOR.replace('my-editor', options);
</script> --}}
@endpush