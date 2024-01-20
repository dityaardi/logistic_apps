{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang</title>
</head>

<table style="border-collapse: collapse; width: 100%; margin-top: 20px;">
    <thead style="border: 1px solid black; padding: 10px; background-color: #f2f2f2;">
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
                <button style="padding: 5px 10px; background-color: #4CAF50; color: white; border: none; cursor: pointer;">
                    View Details
                </button>
                <a href="#" style="margin-left: 10px; color: #1e90ff; text-decoration: none;">
                    <i class="fas fa-edit"></i> Edit
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


    <a href="/barang/create"><button>TAMBAH</button></a>
</body>

</html> --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang</title>
    <style>
        body {
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
            text-align: center;
        }

        button {
            padding: 5px 10px;
            border: none;
            cursor: pointer;
        }

        button.delete {
            background-color: #ff0000;
            color: white;
        }

        button.delete:hover {
            background-color: #cc0000;
        }

        button.tambah {
            background-color: #4CAF50;
            color: white;
        }

        button.tambah:hover {
            background-color: #45a049;
        }

        a {
            text-decoration: none;
            margin-right: 10px;
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
                <th>Kode Produksi</th>
                <th>Nama Barang</th>
                <th>Grade</th>
                <th>Quantity</th>
                <th>Expired At</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($databarang as $barang)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $barang->kode_produksi }}</td>
                <td>{{ $barang->nama_barang }}</td>
                <td>{{ $barang->grade }}</td>
                <td>{{ $barang->quantity }}</td>
                <td>{{ \Carbon\Carbon::parse($barang->expired_at)->format('j F Y') }}</td>
                <td>
                    <a href="#" onclick="deleteItem({{ $barang->id }})">
                        <button class="delete">Delete</button>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="action-buttons">
        <a href="/"><button>Back</button></a>
        <a href="/barang/create"><button class="tambah">Tambah</button></a>
    </div>

    <script>
        function deleteItem(itemId) {
            // Add logic to handle item deletion using AJAX or redirect to a delete route
            alert('Delete item with ID ' + itemId);
        }
    </script>
</body>

</html>
