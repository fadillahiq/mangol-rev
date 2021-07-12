@extends('layouts.admin')

@section('title', 'Data - User')

@section('header')
    <h1>Data User</h1>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4>List User</h4>
          <div class="card-header-action">
            <a href="{{ route('user.create') }}" class="btn btn-primary">Tambah User <i class="fas fa-chevron-right"></i></a>
          </div>
        </div>
        <div class="card-body p-0">
          @if ($message = Session::get('success'))
            <div class="alert alert-success p-2 mx-2 col-md-4">
                {{ $message }}
            </div>
          @endif
          <div class="table-responsive table-invoice">
            <table class="table table-striped">
              <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>
              </tr>
              @forelse ($users as $user)
              <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ \Str::slug($user->getRoleNames()) }}</td>
                <td>
                    <form class="d-flex" action="{{ route('user.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning mr-2">Ubah</a>
                        @if ($user->id == Auth::user()->id)
                        <p class="badge badge-danger m-0 mt-2">Tidak Diperbolehkan</p>
                        @else
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ?')">Hapus</button>
                        @endif
                    </form>
                </td>
              </tr>
              @empty
              <tr>
                  <td colspan="12"><p class="text-center text-danger mt-3"><strong>Data Kosong !</strong></p></td>
              </tr>
              @endforelse
            </table>
            {{ $users->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
