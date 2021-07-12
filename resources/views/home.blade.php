@extends('layouts.admin')

@section('title', 'Dashboard')

@section('header')
    <h1>Dashboard</h1>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
          <i class="fas fa-book"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Komik</h4>
          </div>
          <div class="card-body">
            {{ $total_komik }}
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-danger">
          <i class="far fa-clipboard"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Genre</h4>
          </div>
          <div class="card-body">
            {{ $total_genre }}
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-warning">
          <i class="far fa-bookmark"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Chapter</h4>
          </div>
          <div class="card-body">
            {{ $total_chapter }}
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4>List Komik</h4>
        </div>
        <div class="card-body p-0">
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
                <th>Posted By</th>
                <th>Total Chapter</th>
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
                <td>{{ Str::limit($comic->sinopsis, 50, '...') }}</td>
                <td>{{ $comic->release }}</td>
                <td>{{ $comic->status }}</td>
                <td>{{ $comic->author }}</td>
                <td>{{ $comic->type }}</td>
                <td><a href="{{ asset('komik/'.$comic->thumbnail) }}" target="_blank"><img class="img img-fluid rounded" src="{{ asset('komik/'.$comic->thumbnail) }}" alt="komik thumb"></a></td>
                <td>
                    @foreach ($comic->chapter as $chapter)
                    <strong>
                        <ul>
                            <li>{{ $chapter->user->name }}</li>
                        </ul>
                    </strong>
                    @endforeach
                </td>
                <td>{{ $comic->chapter->count() }}</td>
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
