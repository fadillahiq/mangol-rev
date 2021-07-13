<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comic;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;

class ComicController extends Controller
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
        $comics = Comic::with(['genre', 'user'])->latest()->paginate(10);

        return view('admin.comic.index', compact('comics'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genres = Genre::orderBy('name', 'ASC')->get();

        return view('admin.comic.create', compact('genres'));
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
            'name' => 'required|string|max:255|unique:comics',
            'sinopsis' => 'required|min:8',
            'release' => 'required|numeric',
            'status' => 'required',
            'author' => 'required',
            'type' => 'required',
            'thumbnail' => 'required|image|mimes:jpg,png,svg,gif,jpeg|max:4096'
        ]);

        $slug = Str::slug($request->name);
        $thumbName = time().'.'.$request->file('thumbnail')->getClientOriginalExtension();

        $request->file('thumbnail')->move(public_path().'/'.('komik'), $thumbName);
        $post = Comic::create([
            'name' => $request->name,
            'sinopsis' => $request->sinopsis,
            'release' => $request->release,
            'status' => $request->status,
            'author' => $request->author,
            'type' => $request->type,
            'thumbnail' => $thumbName,
            'slug' => $slug,
            'user_id' => Auth::user()->id
        ]);

        $post->genre()->attach($request->genre);

        return redirect()->route('komik.index')->with('success', 'Komik berhasil dibuat')->with('success', 'Komik berhasil dibuat !');
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
        $genres = Genre::orderBy('name', 'ASC')->get();
        $comic = Comic::with(['genre'])->findOrFail($id);

        return view('admin.comic.edit', compact('comic', 'genres'));
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
        $comic = Comic::findOrFail($id);
        $old_thumb = $comic->thumbnail;
        $this->validate($request, [
            'name' => 'required|string|max:255|unique:comics,name,'.$comic->id,
            'sinopsis' => 'required|min:8',
            'release' => 'required|numeric',
            'status' => 'required',
            'author' => 'required',
            'type' => 'required',
            'thumbnail' => 'image|max:4096|mimes:png,jpg,svg,gif,jpeg'
        ]);


        if($request->has('thumbnail'))
        {
            $slug = Str::slug($request->name);
            $comic_data = [
                'name' => $request->name,
                'sinopsis' => $request->sinopsis,
                'release' => $request->release,
                'status' => $request->status,
                'author' => $request->author,
                'type' => $request->type,
                'thumbnail' => $old_thumb,
                'slug' => $slug,
            ];
            $request->thumbnail->move(public_path().'/komik', $old_thumb);
        } else
        {
            $slug = Str::slug($request->name);
            $comic_data = [
                'name' => $request->name,
                'sinopsis' => $request->sinopsis,
                'release' => $request->release,
                'status' => $request->status,
                'author' => $request->author,
                'type' => $request->type,
                'slug' => $slug
            ];
        }
        $comic->genre()->sync($request->genre);
        $comic->update($comic_data);

        return redirect()->route('komik.index')->with('success', 'Komik berhasil diperbarui')->with('success', 'Komik berhasil diperbarui !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comic = Comic::findOrFail($id);
        $thumb = public_path('/komik/').$comic->thumbnail;
        if(file_exists($thumb))
        {
            @unlink($thumb);
        }
        $comic->delete();

        return redirect()->route('komik.index')->with('success', 'Komik berhasil dihapus')->with('success', 'Genre berhasil dihapus !');
    }
}
