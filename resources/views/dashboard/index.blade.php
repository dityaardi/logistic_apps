<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body style="font-family: Arial;">
    <table>
        <thead>
            <td>No</td>
            <td>No Transaksi</td>
            <td>Nama Pengaju</td>
            <td>Nama Admin</td>
            <td>Quantity</td>
            <td>Tanggal Pengajuan</td>
        </thead>

        <tbody>
            @foreach ($transaksi as $trx)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $trx->no_transaksi }}</td>
                <td>{{ $trx->nama_pengajuan }}</td>
                <td>{{ $trx->nama_admin }}</td>
                <td>{{ $trx->quantity }}</td>
                <td>{{ \Carbon\Carbon::parse($trx->created_at)->format('j F Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>