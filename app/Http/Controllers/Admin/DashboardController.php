<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Comic;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Pagination\Paginator;

class DashboardController extends Controller
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

    public function index()
    {
        Paginator::useBootstrap();
        $total_komik = Comic::count();
        $total_genre = Genre::count();
        $total_chapter = Chapter::count();
        $comics = Comic::with(['chapter.user', 'genre'])->latest()->paginate(10);
        return view('admin.dashboard', compact('total_komik', 'total_genre', 'total_chapter', 'comics'))->with('i');
    }
}
