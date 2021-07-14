<?php

namespace App\Http\Controllers\Mangol;

use App\Http\Controllers\Controller;
use App\Models\Comic;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {

    // menangkap data pencarian
	$search = $request->search;

    // mengambil data dari table pegawai sesuai pencarian data
    $comics = Comic::with('chapter')->where('name','LIKE',"%".$search."%")->orderBy('name', 'ASC')->get();

    // mengirim data pegawai ke view index
    return view('mangol.search.index', compact('comics', 'search'));
    }
}
