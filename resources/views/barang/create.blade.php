<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CREATE BARANG</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 20px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
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
    <form action="/barang/store" method="post">
        @csrf
        <label for="nama_barang">Nama Barang</label>
        <input type="text" name="nama_barang" id="nama_barang">

        <label for="grade">Grade</label>
        <select name="grade" id="grade">
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
        </select>

        <label for="quantity">Quantity</label>
        <input type="number" name="quantity" id="quantity">

        <label for="expired_at">Expired At</label>
        <input type="date" name="expired_at" id="expired_at">

        <button type="submit">CREATE</button>
    </form>
</body>

</html>