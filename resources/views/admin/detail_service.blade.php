@extends('backend.head')
@section('content')
<div class="clearfix"></div>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Rincian Service</div>
                        <hr>
                        <form>
                            <div class="form-group row">
                                <div class="col-3">
                                    <label for="input-1">Nama</label>
                                </div>
                                <div class="col-9">
                                    <p>: {{ $service->kendaraan->pelanggan->nama }}</p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-3">
                                    <label for="input-1">No.Hp</label>
                                </div>
                                <div class="col-9">
                                    <p>: {{ $service->kendaraan->pelanggan->no_hp }}</p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-3">
                                    <label for="input-1">Email</label>
                                </div>
                                <div class="col-9">
                                    <p>: {{ $service->kendaraan->pelanggan->user->email }}</p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-3">
                                    <label for="input-1">Alamat</label>
                                </div>
                                <div class="col-9">
                                    <p>: {{ $service->kendaraan->pelanggan->alamat }}</p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-3">
                                    <label for="input-1">Jenis Kendaraan</label>
                                </div>
                                <div class="col-9">
                                    <p>: {{ $service->kendaraan->jenis_kendaraan }}</p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-3">
                                    <label for="input-1">Merek Kendaraan</label>
                                </div>
                                <div class="col-9">
                                    <p>: {{ $service->kendaraan->merek_kendaraan }}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-3">
                                    <label for="input-1">No.Kendaraan</label>
                                </div>
                                <div class="col-9">
                                    <p>: {{ $service->kendaraan->no_kendaraan }}</p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-3">
                                    <label for="input-1">Total Harga Service</label>
                                </div>
                                <div class="col-9">
                                    <p>: Rp {{number_format($data,2,',','.')}}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                @if ($service->status=="selesai")
                                <a href="/admin/invoice/{{$service->id}}" type="button" class="btn btn-light">
                                    <i class="zmdi zmdi-format-valign-bottom mr-2"></i>Download Invoice
                                </a>
                                @else
                                @if(Auth::check() && Auth::user()->isAdmin())
                                <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    <i class="zmdi zmdi-info-outline mr-2"></i>Selesaikan Service
                                </button>
                                @endif
                                @endif
                            </div>
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title text-white" id="exampleModalLabel">Konfirmasi Penyelesaian
                                            </h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="text-white">Sebelum menyelesaikan service, pastikan pelanggan telah
                                                membayarkan
                                                tagihan
                                                sebesar Rp {{number_format($service->total_harga,2,',','.')}}.
                                                <br>
                                                <strong>Selanjutnya,Invoice service akan dikirimkan ke email pelanggan
                                                    yang
                                                    terdaftar.</strong>
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <a href="/admin/selesai_service/{{$service->id}}" type="button"
                                                class="btn btn-success" id="selesai_service">Selesaikan
                                                Service</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card">
                    <div class="card-header">Detail Service</div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush table-borderless">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Item</th>
                                    <th>Harga</th>
                                    <th>Satuan</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detail as $index => $d)
                                <tr id="row-{{ $d->id }}">
                                    <td scope="row">{{ $index + 1 }}</td>
                                    <td id="item-{{ $d->id }}">{{ $d->barang->nama_barang }}</td>
                                    <td id="harga-{{ $d->id }}">Rp {{number_format($d->barang->harga,2,',','.')}}</td>
                                    <td id="satuan-{{ $d->id }}">{{ $d->satuan }}</td>
                                    <td id="total-{{ $d->id }}">Rp {{number_format($d->total,2,',','.')}}</td>
                                    <td>
                                        {{-- <button class="btn btn-primary btn-sm btn-edit"
                                            data-id="{{ $d->id }}">Edit</button> --}}
                                        @if ($d->service->status!="selesai")
                                        <button class="btn btn-danger btn-sm btn-delete"
                                            data-id="{{ $d->id }}">Hapus</button>
                                        @else
                                        <button class="btn btn-success btn-sm btn-disable"
                                            data-id="{{ $d->id }}">Selesai</button>
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

        <!-- Tombol Tambah Detail -->
        <div class="row mt-3">
            <div class="col-md-8">
                @if ($service->status!="selesai")
                <button class="btn btn-light px-5 mb-3" id="btnTambahDetail"><i class="icon-plus"></i> Tambah
                    Detail Service</button>
                @endif

                <div class="card" id="addForm" style="display: none;">
                    <div class="card-body">
                        <div class="card-title">Tambah Detail Service</div>
                        <hr>
                        <form id="formTambahDetail" action="{{ route('detail_service.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id_user" id="id_user" value="{{ Auth::user()->id }}">

                            <div class="form-group">
                                <label for="jenis_kendaraan">Item</label>
                                <select class="form-control" name="item" id="item">
                                    <option value="">=====PILIH ITEM=====</option>
                                    <optgroup label="Barang">
                                        @foreach ($barang as $b)
                                        <option value="{{$b->id}}">{{$b->nama_barang}}</option>
                                        @endforeach
                                    </optgroup>

                                </select>
                            </div>

                            <input type="hidden" name="id_service" id="id_service" value="{{$service->id}}">
                            <div class="form-group row">
                                <div class="col-3">
                                    <label for="input-1">Nama Barang/Jasa</label>
                                </div>
                                <div class="col-9">
                                    <p id="nama_barang"></p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-3">
                                    <label for="input-1">Harga</label>
                                </div>
                                <div class="col-9">
                                    <p id="harga"></p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-3">
                                    <label for="input-1">Merek</label>
                                </div>
                                <div class="col-9">
                                    <p id="merek_barang"></p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-3">
                                    <label for="input-1">Stok</label>
                                </div>
                                <div class="col-9">
                                    <p id="stok"></p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="satuan">Satuan</label>
                                <input type="text" class="form-control" id="satuan" name="satuan" placeholder="Satuan">
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
        // Ketika tombol Tambah diklik
        $('#btnTambahDetail').click(function() {
            $('#addForm').slideDown();
        });

        // Ketika tombol Batal (Tambah Detail Service) diklik
        $('#cancelTambah').click(function() {
            $('#addForm').slideUp();
            $('#formTambahDetail')[0].reset();
        });

        // Ketika form Tambah Detail Service disubmit
        $('#formTambahDetail').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();

            // Mengirim data tambah detail service via AJAX
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                success: function(response) {
                    // Implementasi logika untuk menampilkan data detail baru
                    $('#formTambahDetail')[0].reset();
                    $('#addForm').slideUp();
                    setTimeout(function() {
                    location.reload();
                }, 10);
                },
                error: function(error) {
                    console.log(error);
                    Swal.fire({
                        title: "Gagal",
                        text: "Kesalahan saat menambah data detail",
                        icon: "error"
                        });
                }
            });
        });
        $('#item').on('change', function(){
            const selectedPackage = $('#item').val();
            var url = "/admin/get_item/"+selectedPackage;
            
            // Mengambil data detail service via AJAX
            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $('#nama_barang').html(response.nama_barang);
                    $('#harga').html(response.harga);
                    $('#merek_barang').html(response.merek_barang);
                    $('#stok').html(response.stok);
                },
                error: function(error) {
                    console.log(error);
                    alert('Terjadi kesalahan saat mengambil data kendaraan.');
                }
            });
        });
        
        // Ketika tombol Hapus diklik
        $(document).on('click', '.btn-delete', function() {
            var detail_id = $(this).data('id');
            var url = "/admin/detail_service/" + detail_id;

            // Konfirmasi penghapusan
            if (confirm('Anda yakin ingin menghapus data ini?')) {
                // Menghapus data kendaraan via AJAX
                $.ajax({
                    type: 'DELETE',
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#row-' + detail_id).remove();
                        Swal.fire({
                        title: "Sukses",
                        text: "Data detail berhasil dihapus",
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
    // Form Selesai Service
    
        
</script>
@include('backend.footer')
@endsection