<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Produk</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            margin: 20px;
            color: #333;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f5f5f5;
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        td img {
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        .footer {
            margin-top: 40px;
            font-size: 12px;
            color: #666;
            text-align: right;
        }
    </style>
</head>
<body>

<h2>DATA PRODUK</h2>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Foto</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($product as $index => $produk) :
            $path = "../public/img/" . $produk['foto'];
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        ?>
        <tr>
            <td><?= $index + 1 ?></td>
            <td><?= $produk['nama'] ?></td>
            <td><?= "IDR " . number_format($produk['harga'], 2, ",", ".") ?></td>
            <td><?= $produk['jumlah'] ?></td>
            <td><img src="<?= $base64 ?>" width="60"></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="footer">
    Diunduh pada <?= date("Y-m-d H:i:s") ?>
</div>

</body>
</html>