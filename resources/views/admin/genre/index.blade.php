@extends('layouts.admin')

@section('title', 'Data - Genre')

@section('header')
    <h1>Data Genre</h1>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4>List Genre</h4>
          <div class="card-header-action">
            <a href="{{ route('genre.create') }}" class="btn btn-primary">Tambah Genre <i class="fas fa-chevron-right"></i></a>
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
                <th>Nama Genre</th>
                <th>Aksi</th>
              </tr>
              @forelse ($genres as $genre)
              <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $genre->name }}</td>
                <td>
                    <form class="d-flex" action="{{ route('genre.destroy', $genre->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <a href="{{ route('genre.edit', $genre->id) }}" class="btn btn-warning mr-2">Ubah</a>
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ?')">Hapus</button>
                    </form>
                </td>
              </tr>
              @empty
              <tr>
                  <td colspan="12"><p class="text-center text-danger mt-3"><strong>Data Kosong !</strong></p></td>
              </tr>
              @endforelse
            </table>
            {{ $genres->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
