@extends('backend.head')
@section('content')
<div class="clearfix"></div>

<div class="content-wrapper">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card">
                    <div class="card-header">Data Barang</div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush table-borderless">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kategori</th>
                                    <th>Nama Barang</th>
                                    <th>Merek</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Keterangan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($barang as $index => $brg)
                                <tr id="row-{{ $brg->id }}">
                                    <td scope="row">{{ $index + 1 }}</td>
                                    <td id="nama_kategori-{{ $brg->id }}">{{ $brg->kategori->nama_kategori }}</td>
                                    <td id="nama_barang-{{ $brg->id }}">{{ $brg->nama_barang }}</td>
                                    <td id="merek_barang-{{ $brg->id }}">{{ $brg->merek_barang }}</td>
                                    <td id="harga-{{ $brg->id }}">Rp {{number_format($brg->harga,2,',','.')}}</td>
                                    <td id="stok-{{ $brg->id }}">{{ $brg->stok }}</td>
                                    <td id="keterangan-{{ $brg->id }}">{{ $brg->keterangan }}</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm btn-edit"
                                            data-id="{{ $brg->id }}">Edit</button>
                                        <button class="btn btn-danger btn-sm btn-delete"
                                            data-id="{{ $brg->id }}">Hapus</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-8">
                <button class="btn btn-light px-5 mb-3" id="btnTambahBarang"><i class="icon-plus"></i> Tambah
                    Barang</button>
                <div class="card" id="addForm" style="display: none;">
                    <div class="card-body m-2">
                        <div class="card-title">Tambah Barang</div>
                        <hr>
                        <form id="formTambahBarang" action="{{ route('barang.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="nama_kategori">Nama Kategori</label>
                                <select name="id_kategori" id="id_kategori" class="form-control">
                                    <option class="form-control">======PILIH KATEGORI======</option>
                                    @foreach ($kategori as $k)
                                    <option class="form-control" value="{{$k->id}}">{{$k->nama_kategori}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="nama_kategori">Nama Barang</label>
                                <input type="text" class="form-control" id="nama_barang" name="nama_barang"
                                    placeholder="Nama Barang">
                            </div>

                            <div class="form-group">
                                <label for="nama_kategori">Merek</label>
                                <input type="text" class="form-control" id="merek_barang" name="merek_barang"
                                    placeholder="Merek">
                            </div>

                            <div class="form-group">
                                <label for="nama_kategori">Harga</label>
                                <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga">
                            </div>

                            <div class="form-group">
                                <label for="nama_kategori">Stok</label>
                                <input type="number" class="form-control" id="stok" name="stok" placeholder="Harga">
                            </div>

                            <div class="form-group">
                                <label for="nama_kategori">Keterangan</label>
                                <textarea type="text" class="form-control" id="nama_barang" name="keterangan"
                                    placeholder="Keterangan barang"></textarea>
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
                    <div class="card-header">Edit Barang</div>
                    <div class="card-body">
                        <form id="formEditBarang">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="edit_nama_barang">Nama Barang</label>
                                <input type="text" class="form-control" id="edit_nama_barang" name="edit_nama_barang">
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
                                <label for="edit_merek_barang">Merek</label>
                                <input type="text" class="form-control" id="edit_merek_barang" name="edit_merek_barang">
                            </div>

                            <div class="form-group">
                                <label for="edit_harga">Harga</label>
                                <input type="text" class="form-control" id="edit_harga" name="edit_harga">
                            </div>

                            <div class="form-group">
                                <label for="edit_stok">Stok</label>
                                <input type="text" class="form-control" id="edit_stok" name="edit_stok">
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
            var barang_id = $(this).data('id');
            var url = "/admin/barang/" + barang_id + "/edit";

            // Mengambil data kategori via AJAX
            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $('#edit_id').val(response.id);
                    $('#edit_nama_barang').val(response.nama_barang);
                    $('#edit_id_kategori').val(response.id_kategori);
                    $('#edit_merek_barang').val(response.merek_barang);
                    $('#edit_harga').val(response.harga);
                    $('#edit_stok').val(response.stok);
                    $('#edit_keterangan').val(response.keterangan);
                    $('#editForm').slideDown();
                },
                error: function(error) {
                    console.log(error);
                    alert('Terjadi kesalahan saat mengambil data kategori.');
                }
            });
        });

        // Ketika tombol Tambah diklik
        $('#btnTambahBarang').click(function() {
            $('#addForm').slideDown();
        });

        // Ketika tombol Batal (Tambah Barang) diklik
        $('#cancelTambah').click(function() {
            $('#addForm').slideUp();
            $('#formTambahBarang')[0].reset();
        });

        // Ketika form Tambah Barang disubmit
        $('#formTambahBarang').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();

            // Mengirim data tambah barang via AJAX
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                success: function(response) {
                    // Implementasi logika untuk menampilkan kategori baru
                    console.log(response);
                    $('#formTambahBarang')[0].reset();
                    $('#addForm').slideUp();
                    
                Swal.fire({
                        title: "Sukses",
                        text: "Berhasil menambahkan data barang",
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
                        text: "Kesalahan saat menambahkan data barang",
                        icon: "error"
                        });
                },
                
            });
        });

        // Ketika tombol Batal (Edit Kategori) diklik
        $('#cancelEdit').click(function() {
            $('#editForm').slideUp();
            $('#formEditBarang')[0].reset();
        });

        // Ketika form Edit Kategori disubmit
        $('#formEditBarang').submit(function(e) {
            e.preventDefault();
            var barang_id = $('#edit_id').val();
            var url = "/admin/barang/" + barang_id;
            var formData = $(this).serialize();

            // Mengirim data perubahan via AJAX
            $.ajax({
                type: 'PUT',
                url: url,
                data: formData,
                success: function(response) {
                    $('#id_kategori-' + response.id).text(response.id_kategori);
                    $('#nama_barang-' + response.id).text(response.nama_barang);
                    $('#merek_barang-' + response.id).text(response.merek_barang);
                    $('#harga-' + response.id).text(response.harga);
                    $('#stok-' + response.id).text(response.stok);
                    $('#keterangan-' + response.id).text(response.keterangan);
                    $('#editForm').slideUp();
                    $('#formEditBarang')[0].reset();
                    Swal.fire({
                        title: "Sukses",
                        text: "Berhasil mengubah data barang",
                        icon: "success"
                        });
                },
                error: function(error) {
                    console.log(error);
                    alert('Terjadi kesalahan saat menyimpan perubahan data barang.');
                }
            });
        });

        // Ketika tombol Hapus diklik
        $(document).on('click', '.btn-delete', function() {
            var barang_id = $(this).data('id');
            var url = "/admin/barang/" + barang_id;

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
                        $('#row-' + barang_id).remove();
                        Swal.fire({
                        title: "Sukses",
                        text: "Berhasil menghapus data barang",
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