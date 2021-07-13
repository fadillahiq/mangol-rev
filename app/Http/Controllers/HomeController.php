<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Comic;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        Paginator::useBootstrap();
        $total_komik = Comic::count();
        $total_genre = Genre::count();
        $total_chapter = Chapter::count();
        $comics = Comic::with(['chapter.user', 'genre', 'user'])->latest()->paginate(10);
        return view('home', compact('total_komik', 'total_genre', 'total_chapter', 'comics'))->with('i');
    }
}
