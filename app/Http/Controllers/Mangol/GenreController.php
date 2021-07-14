<?php

namespace App\Http\Controllers\Mangol;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::with('comic')->orderBy('name', 'ASC')->get();

        return view('mangol.genre.index', compact('genres'));
    }

    public function result_genre($slug)
    {
        $genre = Genre::with('comic.chapter')->where('slug', $slug)->first();

        return view('mangol.genre.result-genre', compact('genre'));
    }
}
