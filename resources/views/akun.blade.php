<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Akun</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
            text-align: center;
        }

        img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin: 10px auto;
            display: block;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #3498db;
            color: #fff;
        }

        button {
            padding: 10px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Akun Pengguna</h2>

    <img src="path/to/user-profile-image.jpg" alt="User Profile">

    <table>
        <tr>
            <th>Nama</th>
            <td>Nama Pengguna</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>user@example.com</td>
        </tr>
        <tr>
            <th>Nomor HP</th>
            <td>1234567890</td>
        </tr>
        <tr>
            <th>Paket yang Dibeli</th>
            <td>Paket A</td>
        </tr>
    </table>

    <h3>Kelengkapan Data</h3>
    <table>
        <tr>
            <th>Alamat</th>
            <td>Alamat Pengguna</td>
        </tr>
        <tr>
            <th>Tanggal Lahir</th>
            <td>01 Januari 1990</td>
        </tr>
        <tr>
            <th>Jenis Kelamin</th>
            <td>Laki-laki</td>
        </tr>
    </table>

    <h3>Lengkapi Data</h3>
    <form id="dataForm">
        <label for="address">Alamat:</label>
        <input type="text" id="address" name="address" required>

        <label for="birthdate">Tanggal Lahir:</label>
        <input type="date" id="birthdate" name="birthdate" required>

        <label for="gender">Jenis Kelamin:</label>
        <select id="gender" name="gender" required>
            <option value="male">Laki-laki</option>
            <option value="female">Perempuan</option>
        </select>

        <button type="submit">Simpan Data</button>
    </form>
</div>

<script>
    document.getElementById('dataForm').addEventListener('submit', function (event) {
        event.preventDefault();
        // Add data submission logic here
        alert('Data submission logic will be implemented here.');
    });
</script>

</body>
</html>
