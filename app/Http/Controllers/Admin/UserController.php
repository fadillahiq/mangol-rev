<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Paginator::useBootstrap();
        $users = User::latest()->paginate(10);

        return view('admin.user.index', compact('users'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
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
            'name' => 'required|string|max:64',
            'email' => 'required|email|max:64|unique:users',
            'password' => 'required|min:8|max:64'
        ]);

        $data = $request->all();
        $data['password'] = bcrypt($request->password);

        $user = User::create($data);

        $user->assignRole('user');

        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan !');
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
        $user = User::findOrFail($id);

        return view('admin.user.edit', compact('user'));
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
        $user = User::findOrFail($id);
        $this->validate($request, [
            'name' => 'required|string|max:64',
            'email' => 'required|email|max:64|unique:users,email,'.$user->id,
        ]);

        if($request->input('password'))
        {
            $this->validate($request, [
                'password' => 'min:8|max:64'
            ]);

            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ];
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email
        ];

        $user->update($data);

        return redirect()->route('user.index')->with('success', 'User berhasil diperbarui !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')->with('success', 'User berhasil dihapus !');
    }
}
