@extends('backend.head')
@section('content')
<div class="clearfix"></div>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card">
                    <div class="card-header"><h3>Data Pelanggan</h3></div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush table-borderless">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Email</th>
                                    <th>No.Hp</th>
                                    <th>Alamat</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pelanggan as $index => $p)
                                <tr id="row-{{ $p->id }}">
                                    <td scope="row">{{ $index + 1 }}</td>
                                    <td id="nama_pelanggan-{{ $p->id }}">{{ $p->nama }}</td>
                                    <td id="email-{{ $p->id }}">{{ $p->user->email }}</td>
                                    <td id="no_hp-{{ $p->id }}">{{ $p->no_hp }}</td>
                                    <td id="alamat-{{ $p->id }}">{{ $p->alamat }}</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm btn-edit" data-id="{{ $p->id }}">Edit</button>
                                        @if(Auth::check() && Auth::user()->isAdmin())
                                        <button class="btn btn-danger btn-sm btn-delete" data-id="{{ $p->id }}">Hapus</button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
            <div class="col-md-4">
                <div class="card" id="editForm" style="display: none;">
                    <div class="card-header">Edit Pelanggan</div>
                    <div class="card-body">
                        <form id="formEditPelanggan">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="edit_id" name="edit_id">
                            <div class="form-group">
                                <label for="edit_nama">Nama</label>
                                <input type="text" class="form-control" id="edit_nama" name="edit_nama">
                            </div>
                            <div class="form-group">
                                <label for="edit_email">Email</label>
                                <input type="email" class="form-control" id="edit_email" name="edit_email">
                            </div>
                            <div class="form-group">
                                <label for="edit_password">Password</label>
                                <input type="password" class="form-control" id="edit_password" name="edit_password" placeholder="Kosongkan jika tidak ingin diubah">
                            </div>
                            <div class="form-group">
                                <label for="edit_no_hp">No. HP</label>
                                <input type="text" class="form-control" id="edit_no_hp" name="edit_no_hp">
                            </div>
                            <div class="form-group">
                                <label for="edit_alamat">Alamat</label>
                                <input type="text" class="form-control" id="edit_alamat" name="edit_alamat">
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
    Swal.fire({
        title: "Sukses",
        text: "{{ session('success') }}",
        icon: "success"
    });
</script>
@endif
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    // Ketika tombol Edit diklik
    $(document).on('click', '.btn-edit', function() {
        var pelanggan_id = $(this).data('id');
        var url = "/admin/pelanggan/" + pelanggan_id + "/edit";

        // Mengambil data pelanggan via AJAX
        $.ajax({
            type: 'GET',
            url: url,
            success: function(response) {
                $('#edit_id').val(response.id);
                $('#edit_nama').val(response.nama);
                $('#edit_email').val(response.user.email);
                $('#edit_no_hp').val(response.no_hp);
                $('#edit_alamat').val(response.alamat);
                $('#editForm').slideDown(); // Menampilkan form edit
            },
            error: function(error) {
                console.log(error);
                Swal.fire({
                    title: "Gagal",
                    text: "Terjadi kesalahan saat mengambil data pelanggan.",
                    icon: "error"
                });
            }
        });
    });

    // Ketika tombol Tambah diklik
    $('#btnTambahPelanggan').click(function() {
        $('#addForm').slideDown();
    });

    // Ketika tombol Batal (Tambah Pelanggan) diklik
    $('#cancelTambah').click(function() {
        $('#addForm').slideUp();
        $('#formTambahPelanggan')[0].reset();
    });

    // Ketika form Tambah Pelanggan disubmit
    $('#formTambahPelanggan').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();

        // Mengirim data tambah pelanggan via AJAX
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            success: function(response) {
                // Implementasi logika untuk menampilkan pelanggan baru
                $('#formTambahPelanggan')[0].reset();
                $('#addForm').slideUp();
                Swal.fire({
                    title: "Sukses",
                    text: "Pelanggan berhasil ditambahkan.",
                    icon: "success"
                }).then(() => {
                    location.reload();
                });
            },
            error: function(error) {
                console.log(error);
                Swal.fire({
                    title: "Gagal",
                    text: "Kesalahan saat menambah data Pelanggan",
                    icon: "error"
                });
            }
        });
    });

    // Ketika tombol Batal (Edit Pelanggan) diklik
    $('#cancelEdit').click(function() {
        $('#editForm').slideUp();
        $('#formEditPelanggan')[0].reset();
    });

    // Ketika form Edit Pelanggan disubmit
    $('#formEditPelanggan').submit(function(e) {
        e.preventDefault();
        var pelanggan_id = $('#edit_id').val();
        var url = "/admin/pelanggan/" + pelanggan_id;
        var formData = $(this).serialize();

        // Mengirim data perubahan via AJAX
        $.ajax({
            type: 'PUT',
            url: url,
            data: formData,
            success: function(response) {
                $('#nama_pelanggan-' + response.id).text(response.nama);
                $('#email-' + response.id).text(response.user.email);
                $('#no_hp-' + response.id).text(response.no_hp);
                $('#alamat-' + response.id).text(response.alamat);
                $('#editForm').slideUp();
                $('#formEditPelanggan')[0].reset();
                Swal.fire({
                    title: "Sukses",
                    text: "Data pelanggan berhasil diperbarui",
                    icon: "success"
                }).then(() => {
                    location.reload();
                });
            },
            error: function(error) {
                console.log(error);
                Swal.fire({
                    title: "Gagal",
                    text: "Terjadi kesalahan saat menyimpan perubahan pelanggan.",
                    icon: "error"
                });
            }
        });
    });
});
</script>
@include('backend.footer')
@endsection
