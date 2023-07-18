@extends('layouts.app')
@section('app')
<div class="container">
    <div class="mb-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Input
        </button>
    </div>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Nama Anggota</th>
                <th scope="col">Majelis</th>
                <th scope="col">Petugas</th>
                <th scope="col">Ditemui</th>
                <th scope="col">Pola Bayar</th>
                <th scope="col">Nominal</th>
                <th scope="col">Dokumentasi</th>
            </tr>
        </thead>
        <tbody>
            @php
            $no=1;
            @endphp
            @foreach ($data as $item)
            <tr>
                <th scope="row">{{ $no++ }}</th>
                <td>{{ $item->tanggal }}</td>
                <td>{{ $item->anggota }}</td>
                <td>{{ $item->majelis }}</td>
                <td>{{ $item->nama_petugas }}</td>
                <td>{{ $item->ditemui }}</td>
                <td>{{ $item->pola_bayar }}</td>
                <td>{{ $item->nominal }}</td>
                <td class="w-25"><img class="img-thumbnail w-25"
                        src="{{ asset(str_replace('public/','storage/',$item->dokumentasi)) }}">
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('monitoring.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Monitoring</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="tanggal" class="form-label fw-bold">Tanggal Kunjungan</label>
                        <input type="date" class="form-control" name="tanggal" id="tgl_kunjungan">
                    </div>
                    <div class="mb-3">
                        <label for="petugas" class="form-label fw-bold">Petugas</label>
                        <select name="nama_petugas" id="petugas" class="form-select">
                            <option value="">--Pilih Petugas--</option>
                            <option value="RIAN ANDRIANI AZIZ">RIAN ANDRIANI AZIZ</option>
                            <option value="IQBAL ABDURAHMAN">IQBAL ABDURAHMAN</option>
                            <option value="YOGI SAPUTRA">YOGI SAPUTRA</option>
                            <option value="SANDY MARTHA">SANDY MARTHA</option>
                            <option value="ARJUNA">ARJUNA</option>
                            <option value="AGUNG RAHAYU">AGUNG RAHAYU</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="majelis" class="form-label fw-bold">Majelis</label>
                        <select name="majelis" id="majelis" class="form-select">
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="anggota" class="form-label fw-bold">Anggota</label>
                        <select name="anggota" id="anggota" class="form-select">
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nominal" class="form-label fw-bold">Nominal Bayar</label>
                        <input type="text" class="form-control" name="nominal" id="nominal" placeholder="10000">
                    </div>
                    <div class="mb-3">
                        <label for="ditemui" class="form-label fw-bold">Bisa ditemui or tidak bisa</label>
                        <div class="d-flex">
                            <div class="form-check">
                                <input class="form-check-input" value="bisa" type="radio" name="ditemui" id="ditemui1">
                                <label class="form-check-label" for="ditemui1">
                                    BISA
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" value="tidak bisa" type="radio" name="ditemui"
                                    id="ditemui2" checked>
                                <label class="form-check-label" for="ditemui2">
                                    TIDAK BISA
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="polabayar" class="form-label fw-bold">Pola Bayar</label>
                        <select name="pola_bayar" id="polabayar" class="form-select">
                            <option class="text-uppercase" value="seminggu sekali">seminggu sekali</option>
                            <option class="text-uppercase" value="sebulan 2 kali">sebulan 2 kali</option>
                            <option class="text-uppercase" value="sebulan 3 kali">sebulan 3 kali</option>
                            <option class="text-uppercase" value="sebulan sekali">sebulan sekali</option>
                            <option class="text-uppercase" value="tidak bayar bayar">tidak bayar bayar</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="kondisi" class="form-label fw-bold text-uppercase">kondisi situasi anggota saat
                            ini</label>
                        <textarea class="form-control" name="kondisi" placeholder="Leave a comment here" id="kondisi"
                            style="height: 100px"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="hasil" class="form-label fw-bold text-uppercase">hasil penagihan atau kunjungan ke
                            PYDB</label>
                        <textarea class="form-control" name="hasil" placeholder="Leave a comment here" id="hasil"
                            style="height: 100px"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="dokumentasi" class="form-label fw-bold text-uppercase">dokumentasi</label>
                        <input type="file" class="form-control" name="dokumentasi" id="dokumentasi">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Proses</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        select_majelis();
        $('#petugas').change(function (e) {
            e.preventDefault();
            var petugas = $(this).val();
            var token = $('meta[name="csrf-token"]').attr('content'); // Ambil nilai token CSRF
            $.ajax({
                url: "{{ route('monitoring.majelis') }}",
                type: "POST",
                data: {
                    petugas: petugas,
                    _token: token // Sertakan token CSRF dalam data permintaan
                },
                success: function (response) {
                    $('#majelis').html(response)
                    var majelis = $('#majelis').val();
                    var token = $('meta[name="csrf-token"]').attr(
                        'content'); // Ambil nilai token CSRF
                    $.ajax({
                        url: "{{ route('monitoring.anggota') }}",
                        type: "POST",
                        data: {
                            majelis: majelis,
                            _token: token
                        },
                        success: function (response) {
                            console.log(response)
                            $('#anggota').html(response)
                        },
                        error: function (xhr, status, error) {
                            console.error(error);
                        }
                    });
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        });

        function select_majelis() {
            $('#majelis').change(function (e) {
                e.preventDefault();
                var majelis = $(this).val();
                var token = $('meta[name="csrf-token"]').attr('content'); // Ambil nilai token CSRF
                $.ajax({
                    url: "{{ route('monitoring.anggota') }}",
                    type: "POST",
                    data: {
                        majelis: majelis,
                        _token: token
                    },
                    success: function (response) {
                        console.log(response)
                        $('#anggota').html(response)
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        }
    });

</script>
@endsection
