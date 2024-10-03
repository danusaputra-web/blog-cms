@extends('back.layout.template')

{{-- pemanggilan css dinamis --}}

@section('title', 'Update Article - Admin')

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Articles</h1>
        </div>
        <div class="mt-3">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ url('articles/'. $article->id) }}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <input type="hidden" name="oldImg" value="{{ $article -> img }}">

                <div class="row">
                    <div class="mb-3 col-6">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title"
                            value="{{ old('title', $article -> title) }}">
                    </div>
                    <div class="mb-3 col-6">
                        <label for="category_id" class="form-label">Category</label>
                        <select class="form-select" id="category_id" name="category_id">
                            <option selected>Choose...</option>
                            @foreach ($categories as $category)
                                @if($category->id == $article ->category_id)
                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                @endif
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Description</label>
                    <textarea class="form-control" id="desc" name="desc"  rows="3" >{{ old('desc', $article -> desc) }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="img" class="form-label">Image (Max 2MB)</label>
                    <input type="file" class="form-control" id="img" name="img">
                    <div class="my-2">
                        <img src="{{ asset('storage/back/' . $article -> img) }}" alt="" width="200" height="200">
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-6">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option selected>Choose...</option>
                            <option value="0" {{ $article->status == 0 ? 'selected' : null }}>Private</option>
                            <option value="1" {{ $article->status == 1 ? 'selected' : null }}>Publish</option>
                        </select>
                    </div>
                    <div class="mb-3 col-6">
                        <label for="publish_date" class="form-label">Publish Date</label>
                        <input type="date" class="form-control" id="publish_date" name="publish_date" value="{{ old('publish_date', $article -> publish_date) }}">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </main>
@endsection
