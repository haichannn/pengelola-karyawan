<?php
// Imported files
require_once "Controllers/karyawanController.php";

// Uses the classes
use Controllers\KaryawanController;

if (isset($_POST["tombol-submit"])) {
   $resultInsertKaryawan = KaryawanController::InsertKaryawan($_POST);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Tambah Data | Karyawan</title>
   <style>
      *,
      html {
         padding: 0;
         margin: 0;
         box-sizing: border-box;
      }

      .container {
         width: 100%;
         height: 100vh;
         display: grid;
         place-content: center;
      }

      .content {
         margin: 1rem 0;
         display: grid;
         gap: 5px;
      }

      .content p {
         font-size: 2em;
         font-family: 'Times New Roman', Times, serif;
      }

      .content a {
         font-size: 1em;
         text-decoration: none;
         font-family: 'Times New Roman', Times, serif;
      }

      .content-form {
         width: 100%;
      }

      .content-form .box-input {
         width: 100%;
         display: grid;
         grid-template-columns: 1fr 1fr;
         grid-template-rows: 1fr 1fr;
         grid-template-areas:
            "username username"
            "email email"
            "tanggalLahir tanggalLahir"
            "jenisKelamin jabatan";
         gap: 5px;
      }

      .content-form .box-input .field-username {
         grid-area: username;
      }

      .content-form .box-input .field-email {
         grid-area: email;
      }

      .content-form .box-input .field-tanggalLahir {
         grid-area: tanggalLahir;
      }

      .content-form .box-input .field-jenisKelamin {
         grid-area: jenisKelamin;
      }

      .content-form .box-input .field-jabatan {
         grid-area: jabatan;
      }

      .content-form .box-input label {
         display: block;
         font-size: 1.2em;
         padding: 10px 0;
         font-family: 'Times New Roman', Times, serif;
      }

      .content-form .box-input input,
      .content-form select {
         padding: 7px;
         border: 1px solid gray;
         border-radius: 2.5px;
         outline: none;
         width: 100%;
      }

      .content-form button {
         padding: 7px;
         border: 1px solid black;
         outline: none;
         width: 100%;
         margin-top: 2rem;
         background-color: lightblue;
      }
   </style>
</head>

<body>
   <main>
      <section class="container">
         <div>
            <div class="content">
               <div>
                  <p>Tambah data karyawan</p>
               </div>

               <div>
                  <a href="index.php">Kembali</a>
               </div>

               <?php if (isset($resultInsertKaryawan)) : ?>
                  <div>
                     <span>
                        <?= ($resultInsertKaryawan == 1) ? "Data berhasil dimasukan !" : $resultInsertKaryawan ?>
                     </span>
                  </div>
               <?php endif ?>
            </div>

            <div class="content-form">
               <form method="post">
                  <div class="box-input">
                     <div class="field-username">
                        <label>Nama Lengkap</label>
                        <input type="text" name="username" required>
                     </div>
                     <div class="field-email">
                        <label>Email</label>
                        <input type="email" name="email" required>
                     </div>
                     <div class="field-tanggalLahir">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tanggalLahir" required>
                     </div>
                     <div class="field-jenisKelamin">
                        <label>Jenis Kelamin</label>
                        <select name="jenisKelamin" required>
                           <option value="pria">Pria</option>
                           <option value="perempuan">Perempuan</option>
                        </select>
                     </div>
                     <div class="field-jabatan">
                        <label>Jabatan</label>
                        <select name="jabatan" required>
                           <option value="1">Manager</option>
                           <option value="2">HRD</option>
                           <option value="3">Supervisor</option>
                           <option value="4">Karyawan</option>
                        </select>
                     </div>
                  </div>
                  <div>
                     <button type="submit" name="tombol-submit">kirim !</button>
                  </div>
               </form>
            </div>
         </div>
      </section>
   </main>
</body>

</html>