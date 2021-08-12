<?php

namespace App\Http\Controllers\Mangol;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Comic;
use App\Models\Comment;
use App\Models\Genre;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

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


    // Detail
    public function detail_komik($slug)
    {
        $comic = Comic::with(['chapter', 'genre', 'user'])->where('slug', $slug)->first();

        return view('mangol.detail.komik', compact('comic'));
    }

    public function detail_chapter($slug)
    {
        $chapter = Chapter::with(['comic', 'user','comment'])->where('slug', $slug)->first();
        $chapters = Chapter::with(['comic'])->where('comic_id', $chapter->comic_id)->orderBy('name', 'desc')->get();

        // get previous
        $previous = Chapter::where('id', '<', $chapter->id)->where('comic_id', $chapter->comic_id)->max('slug');
         // get next
        $next = Chapter::where('id', '>', $chapter->id)->where('comic_id', $chapter->comic_id)->min('slug');

        return view('mangol.detail.chapter', compact('chapter', 'chapters', 'next', 'previous'));
    }


    // Comment
    public function comment_komik(Request $request, $slug)
    {
        $chapter = Chapter::findOrFail($slug);

        $this->validate($request, [
            'name' => 'required|min:4|max:64',
            'body' => 'required|max:300'
        ]);

        $data = $request->all();
        $data['chapter_id'] = $chapter->id;

        Comment::create($data);

        toastr()->success('Komentar berhasil dikirim !');
        return redirect()->back();
    }
}
