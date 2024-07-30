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


    <h5 class="text-center mt-4">Laporan Data Kendaraan Point Motor</h5>
    <p class="text-center">{{(date('d-M-Y', strtotime($tgl_mulai)))}} s.d {{(date('d-M-Y', strtotime($tgl_akhir)))}}</p>

    <div class="table-responsive">
        @if ($kendaraan->count()==0)
        <p class="text-center text-muted fst-italic">No Data Available</p>
        @else
        <table class="table align-items-center table-flush table-borderless">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pemilik</th>
                    <th>No HP</th>
                    <th>Jenis Kendaraan</th>
                    <th>Merek Kendaraan</th>
                    <th>Nomor Kendaraan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kendaraan as $index => $k)
                <tr id="row-{{ $k->id }}">
                    <td scope="row">{{ $index + 1 }}</td>
                    <td id="id_pelanggan-{{ $k->id }}">{{ $k->pelanggan->nama }}</td>
                    <td id="id_pelanggan-{{ $k->id }}">{{ $k->pelanggan->no_hp }}</td>
                    <td id="jenis_kendaraan-{{ $k->id }}">{{ $k->jenis_kendaraan }}</td>
                    <td id="merek_kendaraan-{{ $k->id }}">{{ $k->merek_kendaraan }}</td>
                    <td id="no_kendaraan-{{ $k->id }}">{{ $k->no_kendaraan }}</td>
                </tr>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
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
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</body>

</html>