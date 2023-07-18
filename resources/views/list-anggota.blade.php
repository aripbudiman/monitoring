@extends('layouts.app')
@section('app')

{{-- alert --}}
@if (Session::has('success'))

<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong>{{ Session::get('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Import Anggota
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('import.excel') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Import Anggota</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <input type="file" name="file" class="form-control" id="file">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Import</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="container mt-5">
    <table class="table table-bordered  table-striped">
        <thead>
            <tr class="text-center">
                <th scope="col">No</th>
                <th scope="col">Nama Anggota</th>
                <th scope="col">Majelis</th>
                <th scope="col">Petugas</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @php
            $no=1;
            @endphp
            @foreach ($anggota as $item)
            <tr>
                <th scope="row" class="text-center">{{ $no++ }}</th>
                <td>{{ $item->nama_anggota }}</td>
                <td>{{ $item->majelis }}</td>
                <td>{{ $item->petugas }}</td>
                <td><span class="badge rounded-pill text-bg-danger">{{ $item->status }}</span></td>
                <td class="text-center">
                    <form action="{{ route('update.status',$item->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-sm btn-warning rounded-0">monitor</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{-- <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="#">{{ $anggota->links() }}</a></li>
    </ul>
    </nav> --}}
    <div class="pagination">
        {{ $anggota->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
