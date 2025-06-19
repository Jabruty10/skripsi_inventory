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
            margin-bottom: 10px;
        }
        p {
            text-align: center;
            font-size: 14px;
            margin-bottom: 20px;
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
        .text-center {
            text-align: center;
        }
        .text-right {
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
    <p>Periode: {{ \Carbon\Carbon::parse($start_date)->format('d-m-Y') }} s/d {{ \Carbon\Carbon::parse($end_date)->format('d-m-Y') }}</p>
@endif

@php
    $totalQty = 0;
    $totalHargaKeseluruhan = 0;
@endphp

<table>
    <thead>
        <tr>
            <th class="text-center">No</th>
            <th>Nama Barang</th>
            <th>Pembeli</th>
            <th class="text-center">Harga Jual</th>
            <th class="text-center">Tgl Keluar</th>
            <th class="text-center">Jumlah</th>
            <th class="text-center">Total Harga</th>
        </tr>
    </thead>
    <tbody>
        @foreach($barangKeluar as $index => $data)
            @php
                $subtotal = $data->harga_jual * $data->qty;
                $totalQty += $data->qty;
                $totalHargaKeseluruhan += $subtotal;
            @endphp
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ optional($data->barang)->namabarang ?? '-' }}</td>
                <td>{{ optional($data->pembeli)->namapembeli ?? '-' }}</td>
                <td class="text-right">Rp {{ number_format($data->harga_jual, 0, ',', '.') }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($data->tglkeluar)->format('d-m-Y H:i:s') }}</td>
                <td class="text-center">{{ $data->qty }}</td>
                <td class="text-right">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="5" class="text-end">TOTAL</th>
            <th class="text-center">{{ $totalQty }}</th>
            <th class="text-right">Rp {{ number_format($totalHargaKeseluruhan, 0, ',', '.') }}</th>
        </tr>
    </tfoot>
</table>

</body>
</html>
