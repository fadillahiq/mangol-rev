@extends('layouts.mangol')

@section('title', 'Mangol - Result Genre')

@section('content')
    {{-- title-content --}}
    <div class="section-title mb-4" style="margin-top: 70px;">
        <h5>Result For: "{{ $search }}"</h5>
    </div>
    {{-- end-title-content --}}
    
    {{-- flex --}}
    <div class="flexbox3">
        @forelse ($comics as $comic)
        <div class="flexbox3-item">
            <div class="flexbox3-content">
                <a href="#">
                    <div class="flexbox3-thumb">
                        <img src="{{ asset('komik/'.$comic->thumbnail) }}" class="img-fluid" alt="">
                    </div>
                </a>
                <div class="flexbox3-side">
                    <div>
                        <a href="#">{{ $comic->name }}</a>
                    </div>
                    <ul class="chapter">
                        @foreach ($comic->chapter->sortByDesc('name')->take(3) as $chapters)
                        <li>
                            <a href="#">{{ $chapters->name }}</a>
                            <span class="date">{{ \Carbon\Carbon::parse($chapters->created_at)->diffForHumans() }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @empty
        <p class="badge badge-danger">Tidak ada komik dengan hasil pencarian {{ $search }}</p>
        @endforelse
    </div>
    {{-- end-flex --}}
@endsection