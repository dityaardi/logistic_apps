<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        body {
            font-family: Arial;
            background-color: #f2f2f2;
            margin: 20px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 50%;
            margin: auto;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input,
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            box-sizing: border-box;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            text-align: center;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 10px;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <!-- Add a dropdown for selecting items in the form -->
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

    <!-- Table for displaying selected items -->
    <form action="/store" method="post">
        <table>
            <thead>
                <tr>
                    <th>Kode Produksi</th>
                    <th>Nama Barang</th>
                    <th>Grade</th>
                    <th>Quantity</th>
                    <th>Expired</th>
                </tr>
            </thead>
            <tbody id="result-body">
                <!-- Display selected items here -->
            </tbody>
        </table><br>
        <h1>FORM PENGAJUAN</h1>
        @csrf
        <label for="nama_pengajuan">Nama Pengajuan</label>
        <input type="text" name="nama_pengajuan" id="nama_pengajuan" required>

        <label for="quantity">Quantity</label>
        <input type="number" name="quantity_total" id="quantity" readonly>

        <button type="submit" onclick="submitTransaction()">Submit Transaksi</button>
    </form>

    <script>
        // AJAX form submission handling function
        function submitForm() {
            var formData = $('#request-form').serialize();

            $.ajax({
                type: 'POST',
                url: '/process-request', // Replace with the correct URL
                data: formData,
                success: function(data) {
                    $('#result-body').empty();
                    if(data.message) alert(data.message);
                    else updateTable(data);
                    // Update table with selected items
                }
            });
        }

        // Update table with selected items
        function updateTable(data) {

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

        // Transaction submission handling function
        function submitTransaction() {
            var formData = $('#transaksi').serialize();

            $.ajax({
                data: formData,
                success: function() {
                    alert('Transaction successfully submitted!');
                    // Add logic or page changes after successful transaction submission
                }
            });
        }

        // Function to update "quantity" input based on "request_quantity" input
        function kuantitas() {
            var quantityValue = document.getElementById('request_quantity').value;
            document.getElementById('quantity').value = quantityValue;
        }
    </script>
</body>

</html>