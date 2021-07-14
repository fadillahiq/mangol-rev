<?php

namespace App\Http\Controllers\Mangol;

use App\Http\Controllers\Controller;
use App\Models\Comic;
use App\Models\Genre;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $comics = Comic::with('chapter', 'genre', 'user')->latest()->paginate(10);

        return view('mangol.home.index', compact('comics'));
    }

    public function completed()
    {
        $comics = Comic::where('status', 'Completed')->latest()->paginate(10);

        return view('mangol.home.completed', compact('comics'));
    }
}
