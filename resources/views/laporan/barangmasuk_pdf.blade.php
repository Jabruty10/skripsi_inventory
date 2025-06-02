<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Barang Masuk</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 30px;
            color: #222;
        }

        h3 {
            text-align: center;
            margin-bottom: 5px;
            font-weight: bold;
        }

        p.periode {
            text-align: center;
            margin-bottom: 25px;
            font-size: 13px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        thead th {
            background-color: #2c3e50;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
            padding: 8px;
            border: 1px solid #444;
        }

        tbody td {
            border: 1px solid #444;
            padding: 6px 8px;
            vertical-align: middle;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .right {
            text-align: right;
            font-variant-numeric: tabular-nums;
        }

        tfoot th, tfoot td {
        border-top: 2px solid #222;
        padding: 8px;
        font-weight: bold;
        background-color: #2c3e50;
        color: white;
        }

        tfoot th {
        text-align: right;
        }
    </style>
</head>
<body>

    <h3>Laporan Barang Masuk</h3>
    @if($start_date && $end_date)
        <p class="periode">Periode: {{ $start_date }} s/d {{ $end_date }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th style="width: 3%;">No</th>
                <th style="width: 20%;">Nama Barang</th>
                <th style="width: 15%;">Supplier</th>
                <th style="width: 7%;">Satuan</th>
                <th style="width: 15%;">Deskripsi</th>
                <th style="width: 10%;" class="right">Harga Beli</th>
                <th style="width: 10%;" class="right">Harga Jual</th>
                <th style="width: 10%;">Tgl Masuk</th>
                <th style="width: 5%;" class="right">Jumlah</th>
                <th style="width: 10%;" class="right">Laba</th>
            </tr>
        </thead>
        <tbody>
            @foreach($barangMasuk as $index => $data)
                @php
                    $laba = ($data->harga_jual - $data->harga_beli) * $data->qty;
                @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ optional($data->barang)->namabarang ?? 'Barang tidak ditemukan' }}</td>
                    <td>{{ optional($data->supplier)->namasupplier ?? 'Tidak ada supplier' }}</td>
                    <td>{{ $data->satuan }}</td>
                    <td>{{ $data->deskripsi }}</td>
                    <td class="right">Rp {{ number_format($data->harga_beli, 0, ',', '.') }}</td>
                    <td class="right">Rp {{ number_format($data->harga_jual, 0, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($data->tglmasuk)->format('d-m-Y') }}</td>
                    <td class="right">{{ $data->qty }}</td>
                    <td class="right">Rp {{ number_format($laba, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="8">Total Harga</th>
                <th class="right">{{ number_format($totalHarga, 0, ',', '.') }}</th>
                <th class="right">{{ number_format($totalLaba, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>

</body>
</html>
