@extends('layouts.admin')

@section('title', 'Data - Komik')

@section('header')
    <h1>Data Komik</h1>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4>List Komik</h4>
          <div class="card-header-action">
            <a href="{{ route('komik.create') }}" class="btn btn-primary">Add Post <i class="fas fa-chevron-right"></i></a>
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
                <th>Nama Komik</th>
                <th>Slug</th>
                <th>Genre</th>
                <th>Sinopsis</th>
                <th>Release</th>
                <th>Status</th>
                <th>Auhtor</th>
                <th>Type</th>
                <th>Thumbnail</th>
                <th>Aksi</th>
              </tr>
              @forelse ($comics as $comic)
              <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $comic->name }}</td>
                <td>{{ $comic->slug }}</td>
                <td>
                    @foreach ($comic->genre as $genre)
                        <ul>
                            <li class="badge badge-info">{{ $genre->name }}</li>
                        </ul>
                    @endforeach
                </td>
                <td>{{ $comic->sinopsis }}</td>
                <td>{{ $comic->release }}</td>
                <td>{{ $comic->status }}</td>
                <td>{{ $comic->author }}</td>
                <td>{{ $comic->type }}</td>
                <td><a href="{{ asset('komik/'.$comic->thumbnail) }}" target="_blank"><img class="img img-fluid rounded" src="{{ asset('komik/'.$comic->thumbnail) }}" alt="komik thumb"></a></td>
                {{-- <td>
                @foreach ($comic->genre as $genre)
                    <ul>
                        <h6><span class="badge badge-info">{{ $genre->name }}</span></h6>
                    </ul>
                @endforeach
                </td> --}}
                <td>
                    <form class="d-flex" action="{{ route('komik.destroy', $comic->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <a href="{{ route('komik.edit', $comic->id) }}" class="btn btn-warning mr-2">Ubah</a>
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
            {{ $comics->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
