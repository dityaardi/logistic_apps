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
        <input type="number" name="request_quantity" id="request_quantity" oninput="kuantitas()" />
        <button type="button" onclick="submitForm()">PROCESS REQUEST</button>
    </form><br>

    <!-- Tabel hasil pemilihan barang -->
    <form action="/store" method="post">
        <table id="result-table" style="border-collapse: collapse; width: 50%; text-align: center; ">
            <thead style="border: 1px solid black; padding: 10px;">
                <tr>
                    <th>Kode Produksi</th>
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
        <h1>FORM PENGAJUAN</h1>
        @csrf
        <label for="nama_pengajuan">Nama Pengajuan</label>
        <input type="text" name="nama_pengajuan" id="nama_pengajuan" required>

        {{-- <label for="nama_admin">Nama Admin</label>
        <input type="text" name="nama_admin" id="nama_admin" required> --}}

        <label for="quantity">Quantity</label>
        <input type="number" name="quantity_total" id="quantity" readonly>

        <button type="submit">Submit Transaksi</button>
    </form>
</body>

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
            row += '<td><input type="text" name="kode_produksi[]" value="' + item.kode_produksi + '" readonly></td>';
            row += '<td><input type="text" name="nama_barang[]" value="' + item.nama_barang + '" readonly></td>';
            row += '<td><input type="text" name="grade[]" value="' + item.grade + '" readonly></td>';
            row += '<td><input type="number" name="quantity[]" value="' + item.quantity + '" readonly></td>';
            row += '<td><input type="text" name="expired_at[]" value="' + item.expired_at + '" readonly></td>';
            row += '</tr>';
            $('#result-body').append(row);
        });
    }

    function submitTransaction() {
        var formData = $('#transaksi').serialize();

        $.ajax({
            data: formData,
            success: function() {
                alert('Transaksi berhasil disimpan!');
                // Tambahkan logika atau perubahan halaman setelah transaksi berhasil disimpan
            }
        });
    }

    function kuantitas() {
        // Mendapatkan nilai dari input dengan id "quantity"
        var quantityValue = document.getElementById('request_quantity').value;

        // Memasukkan nilai yang sama ke input dengan id "jumlah"
        document.getElementById('quantity').value = quantityValue;
    }
</script>

</html>