<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengingat Untuk Jadwal Service Kendaraan Anda</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        h1 {
            color: #333;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h2 class="text-align-center">Point Motor - Garage<br>Pengingat Untuk Jadwal Service Kendaraan Anda</h2>
    @if ($notifikasi->service && $notifikasi->service->kendaraan && $notifikasi->service->kendaraan->pelanggan && $notifikasi->service->kendaraan->pelanggan->user)
        <p>Halo <b>{{ $notifikasi->service->kendaraan->pelanggan->nama }}</b>,</p>

        <p>Kami ingin memberitahukan bahwa kendaraan Anda perlu dilakukan service. Berikut adalah detailnya:</
        @if ($notifikasi->service->detail_service->count() > 0)
            <h4>Barang yang Perlu Diservice:</h4>
            <ul>
                @foreach ($notifikasi->service->detail_service as $detailService)
                    <li>{{ $detailService->barang->nama_barang }}</li>
                @endforeach
            </ul>
        @else
            <p>Tidak ada barang yang perlu diservice saat ini.</p>
        @endif

        <p>Harap segera melakukan service untuk menjaga performa kendaraan Anda. Terima kasih!</p>
    @else
        <p>Maaf, informasi tentang service kendaraan Anda tidak lengkap atau tidak ditemukan.</p>
    @endif
</body>
</html>
