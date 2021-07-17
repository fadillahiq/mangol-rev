@extends('layouts.mangol')

@section('title', 'Mangol - Home')

@section('header')
    <div class="row">
        <div class="section-title mt-5 pt-5">
            <h5>Completed</h5>
        </div>
        <div class="section-title mt-5 pt-5 ml-auto">
            <a class="btn btn-warning btn-sm text-dark" href="{{ route('mangol.completed') }}">More...</a>
        </div>
        <div class="owl-carousel owl-theme mt-4">
          @foreach ($comics->where('status', 'Completed')->take(5) as $complete)
            <div class="item">
                <a href="{{ route('mangol.detail.komik', $complete->slug) }}">
                    <img src="{{ asset('komik/'.$complete->thumbnail) }}" class="img" alt="thumbnail-comic">
                </a>
                <div class="content mt-3">
                <a href="{{ route('mangol.detail.komik', $complete->slug) }}"><h6 class="text-center">{{ $complete->name }}</h6></a>
                </div>
            </div>
          @endforeach
        </div>
    </div>
@endsection

@section('content')
    {{-- title-content --}}
    <div class="section-title mt-3 mb-4">
        <h5>Komik Terbaru</h5>
    </div>
    {{-- end-title-content --}}

    {{-- flex --}}
    <div class="flexbox3">
        @foreach ($comics->where('status', 'On Going') as $comic)
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
        @endforeach
    </div>
    {{-- end-flex --}}
@endsection
