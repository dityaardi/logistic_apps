<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang</title>
</head>
<body style="text-align: center; font-family: Arial;">
    <table style="border-collapse: collapse; width: 100%;">
        <thead style="border: 1px solid black; padding: 10px;">
            <th>No</th>
            <th>Kode Produksi</th>
            <th>Nama Barang</th>
            <th>Grade</th>
            <th>Quantity</th>
            <th>Expired At</th>
            <th>Action</th>
        </thead>

        <tbody style="border: 1px solid black; padding: 10px;">
            @foreach($databarang as $barang)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $barang->kode_produksi }}</td>
                <td>{{ $barang->nama_barang }}</td>
                <td>{{ $barang->grade }}</td>
                <td>{{ $barang->quantity }}</td>
                <td>{{ \Carbon\Carbon::parse($barang->expired_at)->format('j F Y') }}</td>
                <td>
                    <!-- <a href="/barang/edit?={{$barang->id_barang}}"><button>EDIT</button></a> -->
                    <form action="/barang/delete/{{$barang->id_barang}}" method="post">
                        @csrf
                        <button>DELETE</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="/barang/create"><button>TAMBAH</button></a>
</body>
</html>