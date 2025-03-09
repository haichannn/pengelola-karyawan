<?php

require "./Controllers/karyawanController.php";

use Controllers\KaryawanController;

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

      .container {
         width: 100%;
         height: 100vh;
         padding: 1rem;
         border: 1px solid red;
         display: grid;
         place-content: center;
         align-content: center;
      }

      .content {
         display: grid;
         gap: 10px;
         margin: 1rem 0;
      }

      .content p {
         font-size: 1.8em;
         font-family: Verdana, Geneva, Tahoma, sans-serif;
      }

      .content a {
         text-decoration: none;
         font-family: 'Times New Roman', Times, serif;
         font-style: italic;
         font-size: 1.2em;
      }

      .content-table table {
         border-collapse: collapse;
      }

      .content-table th,
      .content-table td {
         padding: 10px;
         border: 1px solid black;
         font-family: 'Times New Roman', Times, serif;
         font-size: 1.2em;
      }

      @media screen and (max-width: 420px) {
         .content-table {
            overflow: scroll;
            scroll-behavior: smooth;
            scroll-snap-type: mandatory;
         }
      }
   </style>
</head>

<body>
   <main>
      <section class="container">
         <div class="content">
            <div>
               <p>Daftar Karyawan<p>
            </div>
            <div>
               <a href="addPage.php">Tambah data</a>
            </div>
         </div>

         <div class="content-table">
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
                           <td><?= $Data[1] ?></td> <!-- Nama Lengkap -->
                           <td><?= $Data[2] ?></td> <!-- Email -->
                           <td><?= $Data[3] ?></td> <!-- Jabatan -->

                           <td>
                              <section>
                                 <div>
                                    <a href="deletePage.php?id=<?= $Data[0] ?>">Hapus</a>
                                    <a href="updatePage.php?id=<?= $Data[0] ?>">Edit</a>
                                 </div>
                              </section>
                           </td>
                        </tr>
                        <?php $indexData++ ?>
                     <?php endforeach ?>

                  <?php else : ?>

                     <p style="padding-bottom: 15px;">Data sedang tidak tersedia</p>

                  <?php endif ?>
               </tbody>
            </table>
         </div>
      </section>
   </main>

</body>

</html>