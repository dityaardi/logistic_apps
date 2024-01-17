<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body style="font-family: Arial;">
    <!-- Tambahkan dropdown untuk pilihan barang di dalam form -->
    <form id="request-form">
        @csrf
        <select name="barang_name" id="barang_name">
            @foreach($databarang as $barang)
            <option value="{{ $barang->nama_barang }}">{{ $barang->nama_barang }}</option>
            @endforeach
        </select>
        <input type="number" name="request_quantity" id="request_quantity" />
        <button type="button" onclick="submitForm()">PROCESS REQUEST</button>
    </form><br>

    <!-- Tabel hasil pemilihan barang -->
    <table id="result-table" style="border-collapse: collapse; width: 50%; text-align: center; ">
        <thead style="border: 1px solid black; padding: 10px;">
            <tr>
                <th>Nama Barang</th>
                <th>Grade</th>
                <th>Quantity</th>
                <th>Expired</th>
            </tr>
        </thead>
        <tbody id="result-body" style="border: 1px solid black; padding: 10px;">
            <!-- Hasil pemilihan barang akan ditampilkan di sini -->
        </tbody>
    </table><br>
    <button>SUBMIT</button>

    <script>
        // Fungsi untuk menangani pengiriman formulir menggunakan AJAX
        function submitForm() {
            var formData = $('#request-form').serialize();

            $.ajax({
                type: 'POST',
                url: '/process-request', // Gantilah dengan URL yang sesuai
                data: formData,
                success: function(data) {
                    // Update tabel dengan hasil pemilihan barang
                    updateTable(data);
                }
            });
        }

        // Fungsi untuk memperbarui tabel dengan hasil pemilihan barang
        function updateTable(data) {
            $('#result-body').empty();

            // Iterasi melalui hasil pemilihan barang dan tambahkan ke tabel
            data.forEach(function(item) {
                var row = '<tr>';
                row += '<td>' + item.nama_barang + '</td>';
                row += '<td>' + item.grade + '</td>';
                row += '<td>' + item.quantity + '</td>';
                row += '<td>' + item.expired_at + '</td>';
                row += '</tr>';
                $('#result-body').append(row);
            });
        }
    </script>

</body>

</html>