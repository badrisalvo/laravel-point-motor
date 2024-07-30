@extends('backend.head')
@section('content')
<div class="clearfix"></div>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card">
                    <div class="card-header"><h3>Data Service</h3></div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush table-borderless">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pelanggan</th>
                                    <th>No. HP</th>
                                    <th>No. Kendaraan</th>
                                    <th>Total Harga</th>
                                    <th>Tanggal Service</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($service as $index => $s)
                                <tr id="row-{{ $s->id }}">
                                    <td scope="row">{{ $index + 1 }}</td>
                                    <td id="nama_pelanggan-{{ $s->id }}">{{ $s->kendaraan->pelanggan->nama }}</td>
                                    <td id="no_hp-{{ $s->id }}">{{ $s->kendaraan->pelanggan->no_hp }}</td>
                                    <td id="no_kendaraan-{{ $s->id }}">{{ $s->kendaraan->no_kendaraan }}</td>
                                    @if ($s->total_harga == NULL)
                                    <td id="harga-{{ $s->id }}">-</td>
                                    @else
                                    <td id="harga-{{ $s->id }}">Rp. {{ rtrim(rtrim(number_format($s->total_harga, 2, ',', '.'), '0'), ',') }}</td>
                                    @endif
                                    <td id="created_at-{{ $s->id }}">{{ \Carbon\Carbon::parse($s->created_at)->format('d-m-Y') }}</td>
                                    <td id="status-{{ $s->id }}">{{ $s->status }}</td>
                                    <td>
                                        @if($s->status !== 'selesai')
                                        <button class="btn btn-danger btn-sm btn-delete" data-id="{{ $s->id }}">Hapus</button>
                                        @endif
                                        <a class="btn btn-success btn-sm" data-id="{{ $s->id }}" href="/admin/detail_service/{{ $s->id }}">Detail Service</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- Tombol Tambah Kendaraan -->
        <div class="row mt-3">
            <div class="col-md-8">
                <button class="btn btn-light px-5 mb-3" id="btnTambahService"><i class="icon-plus"></i> Tambah
                    Service</button>
                <div class="card" id="addForm" style="display: none;">
                    <div class="card-body">
                        <div class="card-title">Tambah Service</div>
                        <hr>
                        <form id="formTambahService" action="{{ route('service.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id_user" id="id_user" value="{{ Auth::user()->id }}">
                            <div class="form-group">
                                <label for="no_kendaraan">Nomor Kendaraan</label>
                                <select name="no_kendaraan" id="no_kendaraan" class="form-control">
                                    <option class="form-control">======PILIH Kendaraan======</option>
                                    @foreach ($kendaraan as $k)
                                    <option class="form-control" value="{{$k->no_kendaraan}}">{{$k->no_kendaraan}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-light px-5"><i class="icon-plus"></i>
                                    Tambah</button>
                                <button type="button" class="btn btn-secondary ml-2" id="cancelTambah">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" id="editForm" style="display: none;">
                    <div class="card-header">Edit Kendaraan</div>
                    <div class="card-body">
                        <form id="formEditKendaraan">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="edit_id" name="edit_id">
                            <div class="form-group">
                                <label for="edit_jenis_service">Jenis Kendaraan</label>
                                <input type="text" class="form-control" id="edit_jenis_service"
                                    name="edit_jenis_service">
                            </div>
                            <div class="form-group">
                                <label for="edit_merek_service">Merek Kendaraan</label>
                                <input type="text" class="form-control" id="edit_merek_service"
                                    name="edit_merek_service">
                            </div>
                            <div class="form-group">
                                <label for="edit_no_service">Nomor Kendaraan</label>
                                <input type="text" class="form-control" id="edit_no_service" name="edit_no_service">
                            </div>
                            <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                            <button type="button" class="btn btn-secondary btn-sm" id="cancelEdit">Batal</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('success'))
<script>
    var successMessage = {{session('success')}};
    Swal.fire({
        title: "Sukses",
        text: successMessage,
        icon: "success"
        });
</script>
@endif
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Ketika tombol Edit diklik
        $(document).on('click', '.btn-edit', function() {
            var service_id = $(this).data('id');
            var url = "/admin/service/" + service_id + "/edit";

            // Mengambil data service via AJAX
            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $('#edit_id').val(response.id);
                    $('#edit_jenis_service').val(response.jenis_service);
                    $('#edit_merek_service').val(response.merek_service);
                    $('#edit_no_service').val(response.no_service);
                    $('#editForm').slideDown();
                },
                error: function(error) {
                    console.log(error);
                    alert('Terjadi kesalahan saat mengambil data service.');
                }
            });
        });

        // Ketika tombol Tambah diklik
        $('#btnTambahService').click(function() {
            $('#addForm').slideDown();
        });

        // Ketika tombol Batal (Tambah Kendaraan) diklik
        $('#cancelTambah').click(function() {
            $('#addForm').slideUp();
            $('#formTambahService')[0].reset();
        });

        // Ketika form Tambah Kendaraan disubmit
        $('#formTambahService').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();

            // Mengirim data tambah service via AJAX
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                success: function(response) {
                    // Implementasi logika untuk menampilkan service baru
                    console.log(response);
                    
                    $('#formTambahService')[0].reset();
                    $('#addForm').slideUp();
                    setTimeout(function() {
                    location.reload();
                }, 10);
                },
                error: function(error) {
                    console.log(error);
                    Swal.fire({
                        title: "Gagal",
                        text: "Kesalahan saat menambah data service",
                        icon: "error"
                        });
                }
            });
        });

        // Ketika tombol Batal (Edit Kendaraan) diklik
        $('#cancelEdit').click(function() {
            $('#editForm').slideUp();
            $('#formEditKendaraan')[0].reset();
        });

        // Ketika form Edit Kendaraan disubmit
        $('#formEditKendaraan').submit(function(e) {
            e.preventDefault();
            var service_id = $('#edit_id').val();
            var url = "/admin/service/" + service_id;
            var formData = $(this).serialize();

            // Mengirim data perubahan via AJAX
            $.ajax({
                type: 'PUT',
                url: url,
                data: formData,
                success: function(response) {
                    $('#nama_service-' + response.id).text(response.nama_service);
                    $('#editForm').slideUp();
                    $('#formEditKendaraan')[0].reset();
                    alert('Kendaraan berhasil diperbarui.');
                    location.reload(true);
                },
                error: function(error) {
                    console.log(error);
                    alert('Terjadi kesalahan saat menyimpan perubahan service.');
                }
            });
        });

        // Ketika tombol Hapus diklik
        $(document).on('click', '.btn-delete', function() {
            var service_id = $(this).data('id');
            var url = "/admin/service/" + service_id;

            // Konfirmasi penghapusan
            if (confirm('Anda yakin ingin menghapus service ini?')) {
                // Menghapus data service via AJAX
                $.ajax({
                    type: 'DELETE',
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#row-' + service_id).remove();
                        Swal.fire({
                        title: "Sukses",
                        text: "Data service berhasil dihapus",
                        icon: "success"
                        });
                        location.reload(true);
                    },
                    error: function(error) {
                        console.log(error);
                        Swal.fire({
                        title: "Gagal",
                        text: "Terjadi kesalahan saat menghapus data",
                        icon: "error"
                        });
                    }
                });
            }
        });
    });
</script>
@include('backend.footer')
@endsection