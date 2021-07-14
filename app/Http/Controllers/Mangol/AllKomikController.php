<?php

namespace App\Http\Controllers\Mangol;

use App\Http\Controllers\Controller;
use App\Models\Comic;
use Illuminate\Http\Request;

class AllKomikController extends Controller
{
    public function index()
    {
        $comics = Comic::with('chapter', 'genre', 'user')->orderBy('name', 'ASC')->paginate(10);

        return view('mangol.all-komik.index', compact('comics'));
    }
}
