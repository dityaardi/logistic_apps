{{-- <!DOCTYPE html>
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
</html> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi</title>
    <style>
        body {
            text-align: center;
            font-family: Arial;
            margin: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 10px;
        }

        thead {
            border: 1px solid black;
            padding: 10px;
            background-color: #f2f2f2;
        }

        tbody {
            border: 1px solid black;
            padding: 10px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        a {
            text-decoration: none;
        }

        .action-buttons {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>No Transaksi</th>
                <th>Nama Pengaju</th>
                <th>Nama Admin</th>
                <th>Quantity</th>
                <th>Tanggal Pengajuan</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($transaksi as $trx)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $trx->no_transaksi }}</td>
                <td>{{ $trx->nama_pengajuan }}</td>
                <td>{{ $trx->nama_admin }}</td>
                <td>{{ $trx->quantity }}</td>
                <td>{{ \Carbon\Carbon::parse($trx->created_at)->format('j F Y') }}</td>
                <td>
                    {{-- <form action="/detail-transaksi/{{$trx->no_transaksi}}">
                        @csrf
                        <button>DETAIL</button>
                    </form> --}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="action-buttons">
        <a href="/create"><button>Tambah Transaksi</button></a>
        <a href="/barang"><button>Data Barang</button></a>
    </div>
</body>

</html>
