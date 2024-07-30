@extends('backend.head')
@section('content')
<div class="clearfix"></div>

<div class="content-wrapper">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card">
                    <div class="card-header">Data Jasa</div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush table-borderless">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kategori</th>
                                    <th>Nama Jasa</th>
                                    <th>Harga</th>
                                    <th>Keterangan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jasa as $index => $j)
                                <tr id="row-{{ $j->id }}">
                                    <td scope="row">{{ $index + 1 }}</td>
                                    <td id="kategori-{{ $j->id }}">{{ $j->kategori->nama_kategori }}</td>
                                    <td id="nama_jasa-{{ $j->id }}">{{ $j->nama_jasa }}</td>
                                    <td id="harga-{{ $j->id }}">Rp {{number_format($j->harga,2,',','.')}}</td>
                                    <td id="keterangan-{{ $j->id }}">{{ $j->keterangan }}</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm btn-edit"
                                            data-id="{{ $j->id }}">Edit</button>
                                        <button class="btn btn-danger btn-sm btn-delete"
                                            data-id="{{ $j->id }}">Hapus</button>
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
                <button class="btn btn-light px-5 mb-3" id="btnTambahJasa"><i class="icon-plus"></i> Tambah
                    Jasa</button>
                <div class="card" id="addForm" style="display: none;">
                    <div class="card-body m-2">
                        <div class="card-title">Tambah Jasa</div>
                        <hr>
                        <form id="formTambahJasa" action="{{ route('jasa.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="nama_kategori">Nama Kategori</label>
                                <select name="id_kategori" id="id_kategori" class="form-control" required>
                                    <option class="form-control">======PILIH KATEGORI======</option>
                                    @foreach ($kategori as $k)
                                    <option class="form-control" value="{{$k->id}}">{{$k->nama_kategori}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="nama_kategori">Nama Jasa</label>
                                <input type="text" class="form-control" id="nama_jasa" name="nama_jasa"
                                    placeholder="Nama Jasa" required>
                            </div>

                            <div class="form-group">
                                <label for="nama_kategori">Harga</label>
                                <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="nama_kategori">Keterangan</label>
                                <textarea type="text" class="form-control" id="nama_jasa" name="keterangan"
                                    placeholder="Keterangan jasa" required></textarea>
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
                    <div class="card-header">Edit Jasa</div>
                    <div class="card-body">
                        <form id="formEditJasa">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="edit_nama_jasa">Nama Jasa</label>
                                <input type="text" class="form-control" id="edit_nama_jasa" name="edit_nama_jasa"
                                    required>
                            </div>

                            <input type="hidden" id="edit_id" name="edit_id">
                            <div class="form-group">
                                <label for="edit_nama_kategori">Nama Kategori</label>
                                <select class="form-control" name="edit_id_kategori" id="">
                                    @foreach ($kategori as $ktg)
                                    <option id="selected_kategori" value="{{$ktg->id}}">{{$ktg->nama_kategori}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="edit_harga">Harga</label>
                                <input type="text" class="form-control" id="edit_harga" name="edit_harga">
                            </div>


                            <div class="form-group">
                                <label for="edit_keterangan">Keterangan</label>
                                <input type="text" class="form-control" id="edit_keterangan" name="edit_keterangan">
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Ketika tombol Edit diklik
        $(document).on('click', '.btn-edit', function() {
            var jasa_id = $(this).data('id');
            var url = "/admin/jasa/" + jasa_id + "/edit";

            // Mengambil data kategori via AJAX
            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $('#edit_id').val(response.id);
                    $('#edit_nama_jasa').val(response.nama_jasa);
                    $('#edit_id_kategori').val(response.id_kategori);
                    $('#edit_harga').val(response.harga);
                    $('#edit_keterangan').val(response.keterangan);
                    $('#editForm').slideDown();
                },
                error: function(error) {
                    console.log(error);
                    alert('Terjadi kesalahan saat mengambil data jasa.');
                }
            });
        });

        // Ketika tombol Tambah diklik
        $('#btnTambahJasa').click(function() {
            $('#addForm').slideDown();
        });

        // Ketika tombol Batal (Tambah Jasa) diklik
        $('#cancelTambah').click(function() {
            $('#addForm').slideUp();
            $('#formTambahJasa')[0].reset();
        });

        // Ketika form Tambah Jasa disubmit
        $('#formTambahJasa').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();

            // Mengirim data tambah jasa via AJAX
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                success: function(response) {
                    // Implementasi logika untuk menampilkan kategori baru
                    console.log(response);
                    $('#formTambahJasa')[0].reset();
                    $('#addForm').slideUp();
                    
                Swal.fire({
                        title: "Sukses",
                        text: "Berhasil menambahkan data jasa",
                        icon: "success"
                        });
                        setTimeout(function() {
                    location.reload();
                }, 10);
                },
                
                error: function(error) {
                    console.log(error);
                    Swal.fire({
                        title: "Gagal",
                        text: "Kesalahan saat menambahkan data jasa",
                        icon: "error"
                        });
                },
                
            });
        });

        // Ketika tombol Batal (Edit Jasa) diklik
        $('#cancelEdit').click(function() {
            $('#editForm').slideUp();
            $('#formEditJasa')[0].reset();
        });

        // Ketika form Edit Jasa disubmit
        $('#formEditJasa').submit(function(e) {
            e.preventDefault();
            var jasa_id = $('#edit_id').val();
            var url = "/admin/jasa/" + jasa_id;
            var formData = $(this).serialize();

            // Mengirim data perubahan via AJAX
            $.ajax({
                type: 'PUT',
                url: url,
                data: formData,
                success: function(response) {
                    $('#id_kategori-' + response.id).text(response.id_kategori);
                    $('#nama_jasa-' + response.id).text(response.nama_jasa);
                    $('#harga-' + response.id).text(response.harga);
                    $('#keterangan-' + response.id).text(response.keterangan);
                    $('#editForm').slideUp();
                    $('#formEditJasa')[0].reset();
                    Swal.fire({
                        title: "Sukses",
                        text: "Berhasil mengubah data jasa",
                        icon: "success"
                        });
                        location.reload(true);
                },
                error: function(error) {
                    console.log(error);
                    Swal.fire({
                        title: "Gagal",
                        text: "Terjadi kesalahan saat menyimpan data jasa",
                        icon: "error"
                        });;
                }
            });
        });

        // Ketika tombol Hapus diklik
        $(document).on('click', '.btn-delete', function() {
            var jasa_id = $(this).data('id');
            var url = "/admin/jasa/" + jasa_id;

            // Konfirmasi penghapusan
            if (confirm('Anda yakin ingin menghapus data ini?')) {
                // Menghapus data kategori via AJAX
                $.ajax({
                    type: 'DELETE',
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#row-' + jasa_id).remove();
                        Swal.fire({
                        title: "Sukses",
                        text: "Berhasil menghapus data jasa",
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

<script>
    /* Dengan Rupiah */
    var dengan_rupiah = document.getElementById('dengan-rupiah');
    dengan_rupiah.addEventListener('keyup', function(e)
    {
        dengan_rupiah.value = formatRupiah(this.value, 'Rp. ');
    });
    
    /* Fungsi */
    function formatRupiah(angka, prefix)
    {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split    = number_string.split(','),
            sisa     = split[0].length % 3,
            rupiah     = split[0].substr(0, sisa),
            ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
            
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>
@include('backend.footer')
@endsection