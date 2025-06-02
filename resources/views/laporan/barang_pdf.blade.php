<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Barang</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 40px;
            background-color: #f9f9f9;
            color: #333;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #2c3e50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px 12px;
            text-align: left;
        }

        th {
            background-color: #2c3e50;
            color: #fff;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 14px;
        }

        tr:nth-child(even) {
            background-color: #f4f6f8;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        td {
            font-size: 14px;
        }
    </style>
</head>
<body>
    <h2>Laporan Data Barang</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Deskripsi</th>
                <th>Satuan</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($barangs as $barang)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $barang->namabarang }}</td>
                <td>{{ $barang->deskripsi }}</td>
                <td>{{ $barang->satuan }}</td>
                <td>{{ $barang->stock }}</td>
            </tr>
        @endforeach            
        </tbody>
    </table>
    <br><br><br>
<table style="width: 100%; margin-top: 50px; border: none; border-collapse: collapse;">
    <tr>
        <td style="width: 60%; border: none;"></td>
        <td style="width: 40%; text-align: center; border: none;">
            {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}<br>
            Mengetahui,<br>

            <img src="{{ public_path('assets/img/ttd.jpg') }}" alt="Tanda Tangan" style="width: 150px; height: auto; margin-bottom: 10px;"><br>

            <span style="font-weight: bold; text-decoration: underline;">Siti Aminah</span><br>
            <span style="font-style: italic;">Pemilik Toko</span>
        </td>
    </tr>
</table>

</body>
</html>
