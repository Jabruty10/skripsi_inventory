<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Barang Keluar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }
        h3 {
            text-align: center;
            margin-bottom: 20px;
        }
        p {
            text-align: center;
            margin-bottom: 20px;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }
        th, td {
            border: 1px solid #444;
            padding: 6px 8px;
        }
        th {
            background-color: #2c3e50;
            color: white;
            text-transform: uppercase;
        }
        .right {
            text-align: right;
        }
        tfoot th {
            border-top: 2px solid #000;
            font-weight: bold;
        }
    </style>
</head>
<body>

<h3>Laporan Barang Keluar</h3>
@if($start_date && $end_date)
    <p>Periode: {{ $start_date }} s/d {{ $end_date }}</p>
@endif

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Pembeli</th>
            <th>Harga Jual</th>
            <th>Tgl Keluar</th>
            <th>Jumlah</th>
        </tr>
    </thead>
    <tbody>
        @foreach($barangKeluar as $index => $data)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ optional($data->barang)->namabarang ?? '-' }}</td>
                <td>{{ optional($data->pembeli)->namapembeli ?? '-' }}</td>
                <td class="right">Rp {{ number_format($data->harga_jual, 0, ',', '.') }}</td>
                <td>{{ \Carbon\Carbon::parse($data->tglkeluar)->format('d-m-Y') }}</td>
                <td class="right">{{ $data->qty }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="5" class="right">Total Harga</th>
            <th class="right">Rp {{ number_format($totalHarga, 0, ',', '.') }}</th>
        </tr>
    </tfoot>
</table>

</body>
</html>
