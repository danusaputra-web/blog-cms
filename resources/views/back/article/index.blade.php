@extends('back.layout.template')

{{-- pemanggilan css dinamis --}}
@push('css')
    <link rel="stylesheet" href="https//cdn.datatables.net/2.1.6/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
@endpush

@section('title', 'Articles Admin Management')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Articles</h1>
      </div>
      <div class="mt-3">
        <a href="{{ route('articles.create') }}" class="btn btn-success mb-2">Add Category</a>
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="swal" data-swal="{{ session('success') }}" ></div>

        <table class="table table-striped table-bordered"  id="dataTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Views</th>
                    <th>Status</th>
                    <th>Publish Date</th>
                    <th>Function</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach($articles as $article)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->category->name }}</td>
                    <td>{{ $article->views }}x</td>
                    @if ($article->status == 0)
                        <td><span class="badge bg-danger">private</span></td>
                    @else
                        <td><span class="badge bg-success">public</span></td>
                    @endif
                    <td>{{ $article->publish_date }}</td>
                    <td>
                        <div class="text-center">
                            <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalDetail">Detail</button>
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalUpdate">Edit</button>
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete">Delete</button>
                        </div>
                    </td>
                </tr>
                @endforeach --}}
            </tbody>
        </table>
       </div>
    </main>
@endsection

@push('js')
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.1.6/js/dataTables.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.1.6/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.6/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- alert success --}}

<script>
    const swal = $('.swal').data('swal');
    if(swal){
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: swal,
            showConfirmButton: false,
            timer: 1500
        });
    }

    function deleteArticle(e){
        let id = e.getAttribute('data-id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/articles/'+ id ,
                    type: 'DELETE',
                    dataType: 'json',
                    success: function(){
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        ).then((result) => {
                            window.location.href='/articles';
                        });
                    },
                    error: function(){
                        Swal.fire(
                            'Error!',
                            'Your file has not been deleted.',
                            'error'
                        )
                    }
                });
            }
        });
    }
</script>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ url()->current() }}',
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'title', name: 'title' },
                { data: 'category_id', name: 'category_id' },
                { data: 'views', name: 'views' },
                { data: 'status', name: 'status' },
                { data: 'publish_date', name: 'publish_date' },
                { data: 'action', name: 'action' },
            ]
        });
    } );
</script>
@endpush

