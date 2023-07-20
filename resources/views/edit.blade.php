@extends('layouts.app')
@section('app')
<div class="row col-5">
    <div class="my-5 mx-5 lg-w-50">
        <img class="img-fluid lg-img-thumbnail"
            src="{{ asset(str_replace('public','storage',$monitoring->dokumentasi)) }}" alt="" srcset="">
    </div>
    <form action="{{ route('monitoring.update_dokumentasi',$monitoring->id) }}" method="post"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="dokumentasi" class="form-label fw-bold text-uppercase">dokumentasi</label>
            <input type="file" class="form-control" name="dokumentasi" id="dokumentasi">
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary mx-3">Proses</button>
            <a href="{{ route('monitoring.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>
@endsection
