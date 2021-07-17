<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <title>{{ $chapter->comic->name." ".$chapter->name }}</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>

    <!-- Additional CSS Files -->
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

<!--

TemplateMo 557 Grad School

https://templatemo.com/tm-557-grad-school

-->
  </head>

<body>


  <!--header-->
  @include('includes.navbar')

  <section class="section mb-5 pb-2" style="margin-top: 150px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card" style="background: #101025;">
                    <div class="card-header" style="color: #888; border-bottom: solid 1px;">
                        <div class="row mt-2">
                            <select class="form-control col-md-2 mt-2 ml-1" style="background: #19192e;" name="all_chapter" onchange="location = this.value;">
                                    @foreach ($chapters as $all_chapter)
                                        <option value="{{ route('mangol.detail.chapter', $all_chapter->slug) }}" @if($all_chapter->slug == $chapter->slug) selected @endif>{{ $all_chapter->name }}</option>
                                    @endforeach
                            </select>

                            {{-- <div class="form-group ml-auto mt-2 mr-1">
                                <a class="btn btn-primary btn-sm mr-3" href="{{ $previous }}">« Previous Chapter</a>
                                <a class="btn btn-primary btn-sm" href="{{ $next }}">Next Chapter »</a>
                            </div> --}}
                        </div>
                    </div>

                    <div class="card-body text-center">
                        {!! $chapter->content !!}
                    </div>

                    <div class="card-header" style="color: #888; border-top: solid 1px;">
                        <div class="row mt-2">
                            <select class="form-control col-md-2 mt-2 ml-1" style="background: #19192e;" name="all_chapter_2" onchange="location = this.value;">
                                @foreach ($chapters as $all_chapter_2)
                                    <option value="{{ route('mangol.detail.chapter', $all_chapter_2->slug) }}" @if($all_chapter_2->slug == $chapter->slug) selected @endif>{{ $all_chapter_2->name }}</option>
                                @endforeach
                            </select>

                            {{-- <div class="form-group ml-auto mr-1 mt-2">
                                <a class="btn btn-primary btn-sm mr-3" href="{{ $previous }}">« Previous Chapter</a>
                                <a class="btn btn-primary btn-sm" href="{{ $next }}">Next Chapter »</a>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
  <!-- End Flex -->
    </div>
  </section>

  {{-- <section class="anime-details spad pb-3">
    <div class="container">
        <div class="anime__details__content">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-12 col-md-12">
                    <div class="anime__details__form">
                        <div class="section-title">
                            <h5>Comments</h5>
                        </div>
                        <form action="{{ route('mangol.comments.chapter', $chapter->id) }}" method="POST">
                            @csrf
                            <div class="row mb-2">
                                <div class="col">
                                    <input class="text-dark pl-4 py-1" style="border-radius: 5px; border: none;" type="text" name="name" placeholder="Your Name">
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
                    </div>
                    <div class="anime__details__review mt-5">
                        <div class="section-title">
                            <h5>Your Comments</h5>
                        </div>
                       @foreach ($chapter->comment()->orderBy('created_at', 'desc')->get() as $comment)
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
                    </div>
                </div>
            </div>
        </div>
</section> --}}

  @include('includes.footer')



  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/js/isotope.min.js') }}"></script>
  <script src="{{ asset('assets/js/owl-carousel.js') }}"></script>
  <script src="{{ asset('assets/js/lightbox.js') }}"></script>
  <script src="{{ asset('assets/js/tabs.js') }}"></script>
  <script src="{{ asset('assets/js/video.js') }}"></script>
  <script src="{{ asset('assets/js/slick-slider.js') }}"></script>
  <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>
</html>
