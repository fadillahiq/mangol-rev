@extends('layouts.mangol')

@section('title', 'Mangol - Result Genre')

@section('content')
    {{-- title-content --}}
    <div class="section-title mb-4" style="margin-top: 70px;">
        <h5>Result Genre: {{ $genre->name }}</h5>
    </div>
    {{-- end-title-content --}}

    {{-- flex --}}
    <div class="flexbox3">
        @forelse ($genre->comic as $comic)
        <div class="flexbox3-item">
            <div class="flexbox3-content">
                <a href="{{ route('mangol.detail.komik', $comic->slug) }}">
                    <div class="flexbox3-thumb">
                        <img src="{{ asset('komik/'.$comic->thumbnail) }}" class="img-fluid" alt="">
                    </div>
                </a>
                <div class="flexbox3-side">
                    <div>
                        <a href="{{ route('mangol.detail.komik', $comic->slug) }}">{{ $comic->name }}</a>
                    </div>
                    <ul class="chapter">
                        @foreach ($comic->chapter->sortByDesc('name')->take(3) as $chapter)
                        <li>
                            <a href="{{ route('mangol.detail.chapter', $chapter->slug) }}">{{ $chapter->name }}</a>
                            <span class="date">{{ \Carbon\Carbon::parse($chapter->created_at)->diffForHumans() }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @empty
        <p class="badge badge-danger">Tidak ada komik dengan genre {{ $genre->name }}</p>
        @endforelse
    </div>
    {{-- end-flex --}}
@endsection
