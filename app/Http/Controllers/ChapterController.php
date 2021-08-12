<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Comic;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ChapterController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Paginator::useBootstrap();
        $chapters = Chapter::with(['comic', 'user'])->latest()->paginate('10');

        return view('chapter.index', compact('chapters'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $comics = Comic::orderBy('name', 'ASC')->get();

        return view('chapter.create', compact('comics'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|max:255|string',
            'content' => 'required',
            'comic_id' => 'required|integer',
        ]);

        $comic = Comic::where('id', $request->comic_id)->first();

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['slug'] = Str::slug($comic->name.'-'.$request->name);

        $unique_slug = Chapter::where('slug', 'LIKE', "{$data['slug']}%")->count();

        if($unique_slug > 0)
        {
            return redirect()->back()->withInput($request->input())->with('error', 'Chapter sudah pernah didaftarkan !');
        }else {
            Chapter::create($data);

            return redirect()->route('chapters.index')->with('success', 'Chapter berhasil ditambahkan !');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $chapter = Chapter::findOrFail($id);
        $comics = Comic::orderBy('name', 'ASC')->get();

        return view('chapter.edit', compact('chapter', 'comics'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $chapter = Chapter::with('comic')->findOrFail($id);
        $this->validate($request, [
            'name' => 'required|max:255|string',
            'content' => 'required',
            'comic_id' => 'required|string',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['slug'] = Str::slug($chapter->comic->name.'-'.$request->name);

        $unique_slug = Chapter::where('slug', 'LIKE', "{$data['slug']}%")->whereNotIn('id', [$chapter->id])->count();

        if($unique_slug > 0)
        {
            return redirect()->back()->withInput($request->input())->with('error', 'Chapter sudah pernah didaftarkan !');
        }else {
            $chapter->update($data);

            return redirect()->route('chapters.index')->with('success', 'Chapter berhasil diperbarui !');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $chapter = Chapter::findOrFail($id);
        $chapter->delete();

        return redirect()->route('chapters.index')->with('success', 'Chapter berhasil dihapus !');
    }
}
