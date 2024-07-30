<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* Reset CSS */
        body,
        html {
            margin: 10px;
            padding: 0;
        }

        /* Custom styles for A4 size */
        @page {
            size: A4;
            margin: 1cm;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: 8px;
            border-collapse: collapse;
        }

        .logo {
            max-height: 26px; 
            margin-right: 10px; /* Optional: Adjust the right margin */
            margin-left: -70px;
            margin-top: 10px;
        }

        .title {
            display: inline-block;
            margin-left: 1px;
            font-size: 24px;
        }

        .address {
            font-size: 14px;
            margin-bottom: 10px;
        }

        .line {
            border-top: 1px solid black;
            border-bottom: 1px solid black;
            margin-bottom: 10px;
        }

        .report-title {
            font-size: 18px;
            margin: 20px 0;
        }

        .report-date {
            font-size: 14px;
            margin-bottom: 20px;
        }

        .no-data {
            font-style: italic;
            text-align: center;
            margin: 20px 0;
        }
    </style>
</head>


<body>
<div class="container-fluid">
        <div class="row align-items-center justify-content-center mb-3">
            <div class="col-md-6 text-center">
                <img class="img-fluid logo me-3" alt="Point Motor"
                    src="https://images2.imgbox.com/31/8d/Lt6hvhGx_o.png">
                <h2 class="title d-inline">POINT MOTOR</h2>
            </div>
        </div>
        <div class="text-center address">
            <p>Alamat : Jln.Parak Laweh Pulau Air Nan XX, Gg. Pertemuan No.28, Kec. Lubuk Begalung, Kota Padang, Sumatera Barat 25223</p>
            <div class="line"></div>
        </div>

    <h5 class="text-center mt-4">Laporan Data Service Point Motor</h5>
    <p class="text-center">{{(date('d-M-Y', strtotime($tgl_mulai)))}} s.d {{(date('d-M-Y', strtotime($tgl_akhir)))}}</p>

    <div class="table-responsive">
        @if ($service->count()==0)
        <p class="text-center text-muted fst-italic">No Data Available</p>
        @else
        <table class="table align-items-center table-flush table-borderless">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Transaksi</th>
                    <th>Nama Pelanggan</th>
                    <th>No.Hp</th>
                    <th>Jenis</th>
                    <th>Merek</th>
                    <th>No.Kendaraan</th>
                    <th>Tanggal</th>
                    <th>Total Harga</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($service as $index => $s)
                <tr id="row-{{ $s->id }}">
                    <td scope="row">{{ $index + 1 }}</td>
                    <td id="id-{{ $s->id}}">{{$s->id}}</td>
                    <td id="nama_pelanggan-{{ $s->id }}">{{ $s->kendaraan->pelanggan->nama }}
                    </td>
                    <td id="no_hp-{{ $s->id }}">{{ $s->kendaraan->pelanggan->no_hp }}</td>
                    <td id="email-{{ $s->id }}">{{ $s->kendaraan->jenis_kendaraan }}</td>
                    <td id="alamat-{{ $s->id }}">{{ $s->kendaraan->merek_kendaraan }}</td>
                    <td id="no_kendaraan-{{ $s->id }}">{{ $s->kendaraan->no_kendaraan }}</td>
                    <td id="
                    <td id="no_kendaraan-{{ $s->id }}">{{ \Carbon\Carbon::parse($s->created_at)->format('d-m-Y') }}</td>

                    @if ($s->total_harga ==NULL)
                    <td id="harga-{{ $s->id }}">-</td>
                    @else
                    <td id="harga-{{ $s->id }}">Rp. {{ rtrim(rtrim(number_format($s->total_harga, 2, ',', '.'), '0'), ',') }}</td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
    <div style="width: 200px;margin-left:auto;">
        <p>Padang,{{(date('d-M-Y'))}}</p>
        <p class="fw-bolder" style="margin-bottom:50px"></p>
        <p class="mt-4">Clive Rovend Sonara</p>
    </div>
</body>

</html>