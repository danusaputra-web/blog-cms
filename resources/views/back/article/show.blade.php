@extends('back.layout.template')

{{-- pemanggilan css dinamis --}}

@section('title', 'Detail Article - Admin')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Detail Articles</h1>
      </div>
        <table class="table table-striped table-bordered"  id="dataTable">
                <tr>
                    <th>Title</th>
                    <td>:{{ $article->title }}</td>
                </tr>
                <tr>
                    <th>Category</th>
                    <td>:{{ $article->category->name }}</td>
                </tr>
                <tr>
                    <th>Views</th>
                    <td>:{{ $article->views }}x</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>:
                        @if ($article->status == 0)
                            <span class="badge bg-danger">private</span>
                        @else
                            <span class="badge bg-success">public</span>
                        @endif
                    </td>
                </tr>
                    <th>Image</th>
                    <td>
                        <a href="{{ asset('storage/back/'. $article->img) }}" target="_blank" rel="noopenernoreferrer" >
                        <img src="{{ asset('storage/back/' . $article->img) }}" alt="{{ $article->title }}" width="500" height="600">
                    </td>
                </tr>
                <tr>
                    <th>Publish Date</th>
                    <td>:{{ $article->publish_date }}</td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td>:{{ $article->desc }}</td>
                </tr>
                <tr>

        </table>
       </div>
    </main>
@endsection


