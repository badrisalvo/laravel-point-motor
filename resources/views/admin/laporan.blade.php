@extends('backend.head')
@section('content')
<div class="clearfix"></div>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mt-3">
            <div class="card-content">
                <div class="row row-group m-0">
                    <div class="col-12 col-lg-6 col-xl-3 border-light">
                        <div class="card-body">
                            <h5 class="text-white m-0">Laporan Pelanggan ({{$pelanggan->count()}}) <span
                                    class="float-right"><i class="zmdi zmdi-account"></i></span></h5>

                            <div class="progress my-3" style="height:3px;">
                                <div class="progress-bar" style="width:55%"></div>
                            </div>
                            <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                data-bs-target="#pelanggan">
                                Download Laporan
                            </button>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="pelanggan" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog ">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Download Laporan</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="/admin/laporan/pelanggan" method="post">
                                        @csrf
                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                Tanggal Awal
                                            </div>
                                            <div class="col-md-6">
                                                <input type="date" class="form-control" name="tgl_mulai" required>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                Tanggal Akhir
                                            </div>
                                            <div class="col-md-6">
                                                <input type="date" class="form-control" name="tgl_akhir" required>
                                            </div>
                                        </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Download</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-xl-3 border-light">
                        <div class="card-body">
                            <h5 class="text-white m-0">Laporan Kendaraan ({{$kendaraan->count()}}) <span
                                    class="float-right"><i class="zmdi zmdi-account"></i></span></h5>

                            <div class="progress my-3" style="height:3px;">
                                <div class="progress-bar" style="width:55%"></div>
                            </div>
                            <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                data-bs-target="#kendaraan">
                                Download Laporan
                            </button>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="kendaraan" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog ">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Download Laporan</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="/admin/laporan/kendaraan" method="post">
                                        @csrf
                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                Tanggal Awal
                                            </div>
                                            <div class="col-md-6">
                                                <input type="date" class="form-control" name="tgl_mulai" required>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                Tanggal Akhir
                                            </div>
                                            <div class="col-md-6">
                                                <input type="date" class="form-control" name="tgl_akhir" required>
                                            </div>
                                        </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Download</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-xl-3 border-light">
                        <div class="card-body">
                            <h5 class="text-white m-0">Laporan Service ({{$service->count()}}) <span
                                    class="float-right"><i class="zmdi zmdi-account"></i></span></h5>

                            <div class="progress my-3" style="height:3px;">
                                <div class="progress-bar" style="width:55%"></div>
                            </div>
                            <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                data-bs-target="#service">
                                Download Laporan
                            </button>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="service" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog ">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Download Laporan</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="/admin/laporan/service" method="post">
                                        @csrf
                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                Tanggal Awal
                                            </div>
                                            <div class="col-md-6">
                                                <input type="date" class="form-control" name="tgl_mulai" required>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                Tanggal Akhir
                                            </div>
                                            <div class="col-md-6">
                                                <input type="date" class="form-control" name="tgl_akhir" required>
                                            </div>
                                        </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Download</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-xl-3 border-light">
                        <div class="card-body">
                            <h5 class="text-white m-0">Laporan Barang ({{$barang->count()}}) <span
                                    class="float-right"><i class="zmdi zmdi-account"></i></span></h5>

                            <div class="progress my-3" style="height:3px;">
                                <div class="progress-bar" style="width:55%"></div>
                            </div>
                            <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#barang">
                                Download Laporan
                            </button>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="barang" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog ">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Download Laporan</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="/admin/laporan/barang" method="post">
                                        @csrf
                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                Tanggal Awal
                                            </div>
                                            <div class="col-md-6">
                                                <input type="date" class="form-control" name="tgl_mulai" required>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                Tanggal Akhir
                                            </div>
                                            <div class="col-md-6">
                                                <input type="date" class="form-control" name="tgl_akhir" required>
                                            </div>
                                        </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Download</button>
                                </div>
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

        @include('backend.footer')
        @endsection