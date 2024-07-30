@extends('backend.head')
@section('content')
<div class="clearfix"></div>

<div class="content-wrapper">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card">
                    <div class="card-header"><h3>Data Kendaraan</h3></div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush table-borderless">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pemilik</th>
                                    <th>Jenis Kendaraan</th>
                                    <th>Merek Kendaraan</th>
                                    <th>Nomor Kendaraan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kendaraan as $index => $k)
                                <tr id="row-{{ $k->id }}">
                                    <td scope="row">{{ $index + 1 }}</td>
                                    <td id="id_pelanggan-{{ $k->id }}">{{ $k->pelanggan->nama }}</td>
                                    <td id="jenis_kendaraan-{{ $k->id }}">{{ $k->jenis_kendaraan }}</td>
                                    <td id="merek_kendaraan-{{ $k->id }}">{{ $k->merek_kendaraan }}</td>
                                    <td id="no_kendaraan-{{ $k->id }}">{{ $k->no_kendaraan }}</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm btn-edit"
                                            data-id="{{ $k->id }}">Edit</button>
                                        <button class="btn btn-danger btn-sm btn-delete"
                                            data-id="{{ $k->id }}">Hapus</button>
                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Tambah Kendaraan -->
        <div class="row mt-3">
            <div class="col-md-8">
                <button class="btn btn-light px-5 mb-3" id="btnTambahKendaraan"><i class="icon-plus"></i> Tambah
                    Kendaraan</button>
                <div class="card" id="addForm" style="display: none;">
                    <div class="card-body">
                        <div class="card-title">Tambah Kendaraan</div>
                        <hr>
                        <form id="formTambahKendaraan" action="{{ route('kendaraan.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id_user" id="id_user" value="{{ Auth::user()->id }}">

                            <div class="form-group">
                                <label for="jenis_kendaraan">Jenis Kendaraan</label>
                                <input type="text" class="form-control" id="jenis_kendaraan" name="jenis_kendaraan"
                                    placeholder="Jenis Kendaraan">
                            </div>

                            <div class="form-group">
                                <label for="merek_kendaraan">Merek Kendaraan</label>
                                <input type="text" class="form-control" id="merek_kendaraan" name="merek_kendaraan"
                                    placeholder="Merek Kendaraan">
                            </div>

                            <div class="form-group">
                                <label for="no_kendaraan">Nomor Kendaraan</label>
                                <input type="text" class="form-control" id="no_kendaraan" name="no_kendaraan"
                                    placeholder="Nomor Kendaraan">
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
                                <label for="edit_jenis_kendaraan">Jenis Kendaraan</label>
                                <input type="text" class="form-control" id="edit_jenis_kendaraan"
                                    name="edit_jenis_kendaraan">
                            </div>
                            <div class="form-group">
                                <label for="edit_merek_kendaraan">Merek Kendaraan</label>
                                <input type="text" class="form-control" id="edit_merek_kendaraan"
                                    name="edit_merek_kendaraan">
                            </div>
                            <div class="form-group">
                                <label for="edit_no_kendaraan">Nomor Kendaraan</label>
                                <input type="text" class="form-control" id="edit_no_kendaraan" name="edit_no_kendaraan">
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
            var kendaraan_id = $(this).data('id');
            var url = "/admin/kendaraan/" + kendaraan_id + "/edit";

            // Mengambil data kendaraan via AJAX
            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $('#edit_id').val(response.id);
                    $('#edit_jenis_kendaraan').val(response.jenis_kendaraan);
                    $('#edit_merek_kendaraan').val(response.merek_kendaraan);
                    $('#edit_no_kendaraan').val(response.no_kendaraan);
                    $('#editForm').slideDown();
                },
                error: function(error) {
                    console.log(error);
                    alert('Terjadi kesalahan saat mengambil data kendaraan.');
                }
            });
        });

        // Ketika tombol Tambah diklik
        $('#btnTambahKendaraan').click(function() {
            $('#addForm').slideDown();
        });

        // Ketika tombol Batal (Tambah Kendaraan) diklik
        $('#cancelTambah').click(function() {
            $('#addForm').slideUp();
            $('#formTambahKendaraan')[0].reset();
        });

        // Ketika form Tambah Kendaraan disubmit
        $('#formTambahKendaraan').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();

            // Mengirim data tambah kendaraan via AJAX
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                success: function(response) {
                    // Implementasi logika untuk menampilkan kendaraan baru
                    console.log(response);
                    
                    $('#formTambahKendaraan')[0].reset();
                    $('#addForm').slideUp();
                    setTimeout(function() {
                    location.reload();
                }, 10);
                },
                error: function(error) {
                    console.log(error);
                    Swal.fire({
                        title: "Gagal",
                        text: "Kesalahan saat menambah data kendaraan",
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
            var kendaraan_id = $('#edit_id').val();
            var url = "/admin/kendaraan/" + kendaraan_id;
            var formData = $(this).serialize();

            // Mengirim data perubahan via AJAX
            $.ajax({
                type: 'PUT',
                url: url,
                data: formData,
                success: function(response) {
                    $('#nama_kendaraan-' + response.id).text(response.nama_kendaraan);
                    $('#editForm').slideUp();
                    $('#formEditKendaraan')[0].reset();
                    alert('Kendaraan berhasil diperbarui.');
                    location.reload(true);
                },
                error: function(error) {
                    console.log(error);
                    alert('Terjadi kesalahan saat menyimpan perubahan kendaraan.');
                }
            });
        });

        // Ketika tombol Hapus diklik
        $(document).on('click', '.btn-delete', function() {
            var kendaraan_id = $(this).data('id');
            var url = "/admin/kendaraan/" + kendaraan_id;

            // Konfirmasi penghapusan
            if (confirm('Anda yakin ingin menghapus kendaraan ini?')) {
                // Menghapus data kendaraan via AJAX
                $.ajax({
                    type: 'DELETE',
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#row-' + kendaraan_id).remove();
                        Swal.fire({
                        title: "Sukses",
                        text: "Data kendaraan berhasil dihapus",
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