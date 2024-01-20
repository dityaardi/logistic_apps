<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi</title>
</head>
<body style="text-align: center; font-family: Arial;">
    <table style="border-collapse: collapse; width: 100%;">
        <thead style="border: 1px solid black; padding: 10px;">
            <th>No</th>
            <th>No Transaksi</th>
            <th>Nama Pengaju</th>
            <th>Nama Admin</th>
            <th>Quantity</th>
            <th>Tanggal Pengajuan</th>
            <th>Action</th>
        </thead>

        <tbody style="border: 1px solid black; padding: 10px;">
            @foreach($transaksi as $trx)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $trx->no_transaksi }}</td>
                <td>{{ $trx->nama_pengajuan }}</td>
                <td>{{ $trx->nama_admin }}</td>
                <td>{{ $trx->quantity }}</td>
                <td>{{ \Carbon\Carbon::parse($trx->created_at)->format('j F Y') }}</td>
                <td>
                    <form action="/detail-transaksi/{{$trx->no_transaksi}}">
                        @csrf
                        <button>DETAIL</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="/create"><button>Tambah Transaksi</button></a>
    <a href="/barang"><button>Data Barang</button></a>
</body>
</html>