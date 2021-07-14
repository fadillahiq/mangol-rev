@extends('layouts.mangol')

@section('title', 'Mangol - Genre')

@section('content')
    {{-- title-content --}}
    <div class="section-title mb-4" style="margin-top: 70px;">
        <h5>All Genre</h5>
    </div>
    {{-- end-title-content --}}
    
    <div class="card" style="background-color: #070720; border-color: none;">
      <div class="card-body pt-1 pb-1">
        <div class="row">
            @forelse ($genres as $genre)
                <a class="btn btn-primary btn-sm mr-2" href="{{ route('mangol.genre.result', $genre->slug) }}">{{ $genre->name }}</a>
            @endforeach
        </div>
      </div>
    </div>
@endsection