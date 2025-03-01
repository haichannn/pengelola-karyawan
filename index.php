<?php

require "./Controllers/karyawanController.php";

use Controllers\Karyawan as KaryawanController;

$DatasKaryawan = KaryawanController::GetAllKaryawan();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman utama | Karyawan</title>
    <style>
        *,
        html {
            padding: 0;
            margin: 0;
            box-sizing: border-box
        }

        .container-text {
            margin-top: 2rem;
            text-align: center;
        }

        h2 {
            font-size: 2.8em;
            font-family: 'Times New Roman', Times, serif;
        }

        p {
            font-size: 1.3em;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        .container-table {
            display: grid;
            place-items: center;
            margin-top: 2rem;
        }
    </style>
</head>

<body>
    <main>
        <section class="container-text">
            <div>
                <h2>Halaman Karyawan</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis, sun<p>
            </div>
        </section>
        <section class="container-table">
            <table>
                <thead style="background-color: orange;">
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>Jabatan</th>
                    <th>Action Menu</th>
                </thead>
                <tbody>
                    <?php if ($DatasKaryawan) : ?>
                        <?php $indexData = 1; ?>

                        <?php foreach ($DatasKaryawan as $Data) : ?>
                            <tr>
                                <td><?= $indexData ?></td> <!-- Index Nomer -->
                                <td><?= $Data[0] ?></td>   <!-- Nama Lengkap -->
                                <td><?= $Data[1] ?></td>   <!-- Email -->
                                <td><?= $Data[2] ?></td>   <!-- Jabatan -->

                                <td>
                                    <section>
                                        <div>
                                            <a href="delete.php">Hapus</a>
                                            <a href="edit.php">Edit</a>
                                        </div>
                                    </section>
                                </td>
                            </tr>
                            <?php $indexData++ ?>
                        <?php endforeach ?>

                    <?php else : ?>

                        <h2>Data Tidak Tersedia</h2>

                    <?php endif ?>
                </tbody>
            </table>
        </section>
    </main>

</body>

</html>