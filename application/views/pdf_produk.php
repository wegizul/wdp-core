<!DOCTYPE html>
<html lang="id">

<!-- This Application made with love by Wegi Zulianda
author: wegizulianda@gmail.com
company: https://webdeveloperpku.com -->

<head>
    <meta charset="UTF-8">
    <title>Data Produk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        img {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
        }

        /* Table judul tidak ada border */
        .header-table td {
            border: none !important;
        }

        /* Table list barang ada border */
        .list th,
        .list td {
            border: 1px solid #474747ff;
            padding: 6px;
            text-align: left;
        }

        .right {
            text-align: right;
        }
    </style>
</head>

<body>
    <table class="header-table">
        <thead>
            <tr>
                <td>
                    <img src="https://so.webdeveloperpku.com/assets/files/logo.png" width="200px" style="float: left;">
                </td>
                <td style="text-align: right;">
                    <b style="font-size: 20px; margin-bottom:3px;">DATA PRODUK</b><br>
                    <i>Dicetak pada <?= date('d/m/Y H:i:s') ?></i>
                </td>
            </tr>
        </thead>
    </table>
    <hr size="3" style="margin-top: 25px;">

    <table class="list">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Produk</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Satuan</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($data as $i) { ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $i->prd_kode; ?></td>
                    <td><?= $i->prd_nama; ?></td>
                    <td><?= $i->kp_nama; ?></td>
                    <td><?= $i->prd_stok; ?></td>
                    <td><?= $i->sb_nama; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>