<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CREATE BARANG</title>
</head>
<body>
    <form action="/barang/store" method="post">
        @csrf
        <label for="nama_barang">Nama Barang</label>
        <input type="text" name="nama_barang" id="nama_barang"><br>

        <label for="grade">Grade</label>
        <select name="grade" id="grade">
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
        </select><br>

        <label for="quantity">Quantity</label>
        <input type="number" name="quantity" id="quantity"><br>
        
        <label for="expired_at">Expired At</label>
        <input type="date" name="expired_at" id="expired_at"><br>

        <button type="submit">CREATE</button>
    </form>
</body>
</html>