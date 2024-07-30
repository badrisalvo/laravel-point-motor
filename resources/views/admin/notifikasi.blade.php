@extends('backend.head')
@section('content')
<div class="clearfix"></div>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card">
                    <div class="card-header"><h3>Data Reminder</h3></div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush table-borderless">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pelanggan</th>
                                    <th>No.Hp</th>
                                    <th>Email</th>
                                    <th>No.Kendaraan</th>
                                    <th>Total Harga</th>
                                    <th>Diingatkan pada</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($service as $index => $s)
                                <tr id="row-{{ $s->id }}">
                                    <td scope="row">{{ $index + 1 }}</td>
                                    <td id="nama_pelanggan-{{ $s->id }}">{{ $s->kendaraan->pelanggan->nama }}</td>
                                    <td id="no_hp-{{ $s->id }}">{{ $s->kendaraan->pelanggan->no_hp }}</td>
                                    <td id="email-{{ $s->id }}">{{ $s->kendaraan->pelanggan->user->email }}</td>
                                    <td id="no_kendaraan-{{ $s->id }}">{{ $s->kendaraan->no_kendaraan }}</td>
                                    @if ($s->total_harga == NULL)
                                    <td id="harga-{{ $s->id }}">-</td>
                                    @else
                                    <td id="harga-{{ $s->id }}">Rp {{ number_format($s->total_harga,2,',','.') }}</td>
                                    @endif
                                    <td>
                                        @if($s->notifikasi)
                                        {{ $s->notifikasi->remind_at->format('d-m-Y') }}
                                        @else
                                        -
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-set-reminder" data-id="{{ $s->id }}" data-bs-toggle="modal" data-bs-target="#reminderModal">
                                            Atur Tanggal Pengingat
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Tombol Kirim Notifikasi -->
                    <div class="card-footer">
                        @if(Auth::check() && Auth::user()->isAdmin())
                        <form action="{{ route('admin.sendReminders') }}" method="POST" class="d-inline-block">
                            @csrf
                            <button type="submit" class="btn btn-primary">Kirim Pengingat</button>
                        </form>
                        @endif
                        
                        <a href="https://api.whatsapp.com/send/?phone=%2B14155238886&text=join+aid-city&type=phone_number&app_absent=0" target="_blank" class="btn btn-primary d-inline-block ml-2">Verifikasi Notifikasi Whatsapp</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="reminderModal" tabindex="-1" aria-labelledby="reminderModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="reminderModalLabel">Notifikasi Pengingat</h1>
                    </div>
                    <form action="{{ route('atur_pengingat') }}" method="post">
                        @csrf
                        <input type="hidden" name="id_service" id="modal_service_id">
                        <div class="modal-body">
                            <label for="jumlah_hari">Jumlah Hari:</label>
                            <input class="form-control" type="number" name="jumlah_hari" id="jumlah_hari" min="1" required>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Atur Pengingat</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "{{ session('success') }}",
                timer: 3000,
                showConfirmButton: false
            });
        </script>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const reminderModal = new bootstrap.Modal(document.getElementById('reminderModal'));
        const modalServiceId = document.getElementById('modal_service_id');
        const btnSetReminder = document.querySelectorAll('.btn-set-reminder');

        btnSetReminder.forEach(button => {
            button.addEventListener('click', function() {
                const serviceId = this.getAttribute('data-id');
                modalServiceId.value = serviceId;
                reminderModal.show();
            });
        });
    });
</script>
@include('backend.footer')
@endsection
