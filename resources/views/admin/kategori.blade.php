@extends('backend.head')
@section('content')
<div class="clearfix"></div>

<div class="content-wrapper">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card">
                    <div class="card-header"><h3>Data Kategori</h3></div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush table-borderless">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kategori</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kategori as $index => $ktg)
                                <tr id="row-{{ $ktg->id }}">
                                    <td scope="row">{{ $index + 1 }}</td>
                                    <td id="nama_kategori-{{ $ktg->id }}">{{ $ktg->nama_kategori }}</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm btn-edit"
                                            data-id="{{ $ktg->id }}">Edit</button>
                                        <button class="btn btn-danger btn-sm btn-delete"
                                            data-id="{{ $ktg->id }}">Hapus</button>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Tambah Kategori -->
        <div class="row mt-3">
            <div class="col-md-8">
                <button class="btn btn-light px-5 mb-3" id="btnTambahKategori"><i class="icon-plus"></i> Tambah
                    Kategori</button>
                <div class="card" id="addForm" style="display: none;">
                    <div class="card-body">
                        <div class="card-title">Tambah Kategori</div>
                        <hr>
                        <form id="formTambahKategori" action="{{ route('kategori.tambah') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="nama_kategori">Nama Kategori</label>
                                <input type="text" class="form-control" id="nama_kategori" name="nama_kategori"
                                    placeholder="Nama Kategori">
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
                    <div class="card-header">Edit Kategori</div>
                    <div class="card-body">
                        <form id="formEditKategori">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="edit_id" name="edit_id">
                            <div class="form-group">
                                <label for="edit_nama_kategori">Nama Kategori</label>
                                <input type="text" class="form-control" id="edit_nama_kategori"
                                    name="edit_nama_kategori">
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Ketika tombol Edit diklik
        $(document).on('click', '.btn-edit', function() {
            var kategori_id = $(this).data('id');
            var url = "/admin/kategori/" + kategori_id + "/edit";

            // Mengambil data kategori via AJAX
            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $('#edit_id').val(response.id);
                    $('#edit_nama_kategori').val(response.nama_kategori);
                    $('#editForm').slideDown();
                },
                error: function(error) {
                    console.log(error);
                    alert('Terjadi kesalahan saat mengambil data kategori.');
                }
            });
        });

        // Ketika tombol Tambah diklik
        $('#btnTambahKategori').click(function() {
            $('#addForm').slideDown();
        });

        // Ketika tombol Batal (Tambah Kategori) diklik
        $('#cancelTambah').click(function() {
            $('#addForm').slideUp();
            $('#formTambahKategori')[0].reset();
        });

        // Ketika form Tambah Kategori disubmit
        $('#formTambahKategori').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();

            // Mengirim data tambah kategori via AJAX
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                success: function(response) {
                    // Implementasi logika untuk menampilkan kategori baru
                    console.log(response);
                    alert('Kategori berhasil ditambahkan.');
                    $('#formTambahKategori')[0].reset();
                    $('#addForm').slideUp();
                    setTimeout(function() {
                    location.reload();
                }, 10);
                },
                error: function(error) {
                    console.log(error);
                    alert('Terjadi kesalahan saat menambah kategori.');
                }
            });
        });

        // Ketika tombol Batal (Edit Kategori) diklik
        $('#cancelEdit').click(function() {
            $('#editForm').slideUp();
            $('#formEditKategori')[0].reset();
        });

        // Ketika form Edit Kategori disubmit
        $('#formEditKategori').submit(function(e) {
            e.preventDefault();
            var kategori_id = $('#edit_id').val();
            var url = "/admin/kategori/" + kategori_id;
            var formData = $(this).serialize();

            // Mengirim data perubahan via AJAX
            $.ajax({
                type: 'PUT',
                url: url,
                data: formData,
                success: function(response) {
                    $('#nama_kategori-' + response.id).text(response.nama_kategori);
                    $('#editForm').slideUp();
                    $('#formEditKategori')[0].reset();
                    alert('Kategori berhasil diperbarui.');
                    location.reload(true);
                },
                error: function(error) {
                    console.log(error);
                    alert('Terjadi kesalahan saat menyimpan perubahan kategori.');
                }
            });
        });

        // Ketika tombol Hapus diklik
        $(document).on('click', '.btn-delete', function() {
            var kategori_id = $(this).data('id');
            var url = "/admin/kategori/" + kategori_id;

            // Konfirmasi penghapusan
            if (confirm('Anda yakin ingin menghapus kategori ini?')) {
                // Menghapus data kategori via AJAX
                $.ajax({
                    type: 'DELETE',
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#row-' + kategori_id).remove();
                        alert('Kategori berhasil dihapus.');
                    },
                    error: function(error) {
                        console.log(error);
                        alert('Terjadi kesalahan saat menghapus kategori.');
                    }
                });
            }
        });
    });
</script>
@include('backend.footer')
@endsection