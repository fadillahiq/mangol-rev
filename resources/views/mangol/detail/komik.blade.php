<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $comic->name }}</title>
        <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900" rel="stylesheet">
        <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('detail-manga-default/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('detail-manga-default/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('detail-manga-default/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('detail-manga-default/css/plyr.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('detail-manga-default/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('detail-manga-default/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('detail-manga-default/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('detail-manga-default/css/style.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('detail-manga-default/assets/css/templatemo-grad-school.css') }}">
    <link rel="stylesheet" href="{{ asset('detail-manga-default/assets/css/custom.css') }}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <link rel="stylesheet" href="{{ asset('detail-manga-default/css/clist.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('detail-manga-default/css/custom.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('detail-manga-default/css/customlist.css') }}" type="text/css">
</head>
<body>

    @include('includes.navbar')

        <!-- Anime Section Begin -->
        <section class="anime-details spad mt-5 pb-3">
            <div class="container">
                <div class="anime__details__content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb__links">
                            <a href="{{ route('mangol.home') }}"><i class="fa fa-home"></i> Home</a>
                            <span>{{ $comic->name }}</span>
                        </div>
                    </div>
                </div>
                    <div class="row mt-5">
                        <div class="col-lg-3">
                            <div class="anime__details__pic set-bg" data-setbg="{{ asset('komik/'.$comic->thumbnail) }}">
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="anime__details__text">
                                <div class="anime__details__title">
                                    <h3>{{ $comic->name }}</h3>
                                </div>
                                <div class="synopsiss">
                                    <h4 class="pl-1 mb-2" style="color: #b7b7b7;">Sinopsis :</h4>
                                    <p>{{ $comic->sinopsis }}</p>
                                </div>
                                <div class="anime__details__widget mt-4">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <ul class="content-info-manga">
                                                <li class="mb-1"><span>Type:</span>{{ $comic->type }}</li>
                                                <li><span>Released:</span>{{ $comic->release }}</li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <ul class="content-info-manga">
                                                <li class="mb-1"><span>Status:</span>{{ $comic->status }}</li>
                                                <li><span>Author:</span>{{ $comic->author }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <ul class="content-info-manga">
                                                <li><span>Genre:</span>
                                                    @foreach ($comic->genre as $genre)
                                                        <a href="{{ route('mangol.genre.result', $genre->slug) }}" class="btn btn-secondary btn-sm rounded-pill">{{ $genre->name }}</a>
                                                    @endforeach
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-9 col-md-12">
                            <div class="series-chapter">
                                <h2 class="pb-3"><span>Chapter List</span></h2>
                                @foreach ($comic->chapter->sortByDesc('created_at') as $chapter)
                                <ul class="series-chapterlist">
                                    <li>
                                        <div class="flexch">
                                            <div class="flexch-book">
                                                <i class="fas fa-book-open"></i>
                                            </div>
                                            <div class="flexch-infoz">
                                                <a href="{{ route('mangol.detail.chapter', $chapter->slug) }}"><span>{{ $chapter->name }}</span></a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                @endforeach
                            </div>
                            {{-- <div class="anime__details__form pt-5">
                                <div class="section-title">
                                    <h5>Comments</h5>
                                </div>
                                <form action="{{ route('mangol.comment.komik', $comic->slug) }}" method="POST">
                                    @csrf
                                    <div class="row mb-2">
                                        <div class="col">
                                            <input class="text-dark pl-3 py-1" style="border-radius: 5px; border: none;" type="text" name="name" placeholder="Your Name">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col">
                                            <input class="text-dark pl-3 py-1" style="border-radius: 5px; border: none;" type="email" name="email" placeholder="Your Email">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <textarea class="text-dark"  placeholder="Your Comment" name="body"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col text-right">
                                            <button type="submit"><i class="fa fa-location-arrow"></i> Kirim</button>
                                        </div>
                                    </div>
                                </form>
                            </div> --}}
                            {{-- <div class="anime__details__review mt-5">
                                <div class="section-title">
                                    <h5>Your Comments</h5>
                                </div>
                               @foreach ($comic->comments->orderBy('created_at', 'desc')->get() as $comment)
                               <div class="anime__review__item">
                                    <div class="anime__review__item__pic">
                                        <img src="../../assets/images/review-6.jpg" alt="">
                                    </div>
                                    <div class="anime__review__item__text">
                                        <h6>{{ $comment->name }} - <span>{{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</span></h6>
                                        <p>{{ $comment->body }}</p>
                                    </div>
                                </div>
                               @endforeach
                            </div> --}}
                        </div>
                    </div>
                </div>
        </section>
            <!-- Anime Section End -->

    @include('includes.footer')

    <script src="{{ asset('detail-manga-default/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('detail-manga-default/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('detail-manga-default/js/player.js') }}"></script>
    <script src="{{ asset('detail-manga-default/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('detail-manga-default/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('detail-manga-default/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('detail-manga-default/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('detail-manga-default/js/main.js') }}"></script>
    <script src="{{ asset('detail-manga-default/assets/js/custom.js') }}"></script>
</body>
</html>
