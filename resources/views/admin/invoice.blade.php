<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Point Motor Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @page {
            size: A4 ;
        }
        body {
            background: #eee;
            margin-top: 5px;
        }
        .receipt-main {
            background: #ffffff;
            border-bottom: 12px solid #333333;
            border-top: 12px solid #9f181c;
            margin: 5px auto;
            padding: 40px 30px;
            position: relative;
            box-shadow: 0 1px 21px #acacac;
            color: #333333;
            font-family: 'Open Sans', sans-serif;
            max-width: 800px;
            margin: 0 auto;
        }
        .receipt-main p {
            color: #333333;
            line-height: 1.42857;
        }
        .receipt-main::after {
            background: #414143;
            content: "";
            height: 5px;
            left: 0;
            position: absolute;
            right: 0;
            top: -13px;
        }
        .receipt-main thead {
            background: #414143;
        }
        .receipt-main thead th {
            color: #fff;
        }
        .receipt-main td, .receipt-main th {
            padding: 9px 20px;
            font-size: 13px;
        }
        .receipt-main td h2 {
            font-size: 20px;
            font-weight: 900;
            margin: 0;
            text-transform: uppercase;
        }
        .receipt-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .receipt-header .receipt-left img {
            width: 71px;
            border-radius: 1px;
        }
        .receipt-right p {
            font-size: 12px;
            margin: 0;
        }
        .receipt-right p i {
            text-align: center;
            width: 18px;
        }
    </style>
</head>
<body>
    <div class="receipt-main">
        <div class="receipt-header">
            <div class="receipt-left">
                <img class="img-responsive" alt="Point Motor" src="https://images2.imgbox.com/31/8d/Lt6hvhGx_o.png">
            </div>
            <div class="receipt-right text-right">
                <h5>Point Motor</h5>
                <p>Invoice Service <i class="fa fa-phone"></i></p>
                <p>pointmotor@gmail.com <i class="fa fa-envelope-o"></i></p>
                <p>Parak Laweh Pulau Air Nan XX, Gg. Pertemuan No.28,<br>Kec. Lubuk Begalung, Kota Padang, Sumatera Barat 25223 <i class="fa fa-location-arrow"></i></p>
            </div>
        </div>
        
        <div class="receipt-header receipt-header-mid">
            <div class="receipt-right">
                <p><b>Nama         :</b> {{ $service->kendaraan->pelanggan->nama }}</p>
                <p><b>No.Handphone :</b> {{ $service->kendaraan->pelanggan->no_hp }}</p>
                <p><b>Tanggal      :</b> {{ date('d-M-Y', strtotime($tanggal)) }}</p>
                <p><b>Service Id   :</b> {{ $service->id }}</p>
                <p><b>Merek Kendaraan :</b> {{ $service->kendaraan->merek_kendaraan}}</p>
                <p><b>Jenis Kendaraan :</b> {{ $service->kendaraan->jenis_kendaraan}}</p>
                <p><b>No Kendaraan :</b> {{ $service->kendaraan->no_kendaraan}}</p>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table align-items-center table-flush table-borderless">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Item</th>
                        <th>Harga</th>
                        <th>Satuan</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($detail as $index => $d)
                    <tr id="row-{{ $d->id }}">
                        <td scope="row">{{ $index + 1 }}</td>
                        <td id="item-{{ $d->id }}">{{ $d->barang->nama_barang }}</td>
                        <td id="harga-{{ $d->id }}">Rp {{ number_format($d->barang->harga, 2, ',', '.') }}</td>
                        <td id="satuan-{{ $d->id }}">{{ $d->satuan }}</td>
                        <td id="total-{{ $d->id }}">Rp {{ number_format($d->total, 2, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="row mx-auto">
            <div class="col-md-7">
            <p style="font-size: 14px;">Total Pembayaran : Rp {{ number_format($data2, 2, ',', '.') }}</p>
            </div>
        </div>
    </div>
</body>
</html>
