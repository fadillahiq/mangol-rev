@extends('layouts.admin')

@section('title', 'Data - Chapter')

@section('header')
    <h1>Data Chapter</h1>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4>List Chapter</h4>
          <div class="card-header-action">
            <a href="{{ route('chapter.create') }}" class="btn btn-primary">Tambah Chapter <i class="fas fa-chevron-right"></i></a>
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
                <th>Nama Chapter</th>
                <th>Slug</th>
                <th>Komik</th>
                <th>Posted By</th>
                <th>Aksi</th>
              </tr>
              @forelse ($chapters as $chapter)
              <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $chapter->name }}</td>
                <td>{{ $chapter->slug }}</td>
                <td>{{ $chapter->comic->name }}</td>
                <td>{{ $chapter->user->name }}</td>
                <td>
                    @if ($chapter->user_id == Auth::user()->id)
                    <form class="d-flex" action="{{ route('chapter.destroy', $chapter->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <a href="{{ route('chapter.edit', $chapter->id) }}" class="btn btn-warning mr-2">Ubah</a>
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ?')">Hapus</button>
                    </form>
                    @else
                    <p class="badge badge-danger">Tidak Punya Akses !</p>
                    @endif
                </td>
              </tr>
              @empty
              <tr>
                  <td colspan="12"><p class="text-center text-danger mt-3"><strong>Data Kosong !</strong></p></td>
              </tr>
              @endforelse
            </table>
            {{ $chapters->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
