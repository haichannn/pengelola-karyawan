<?php
// Imported files
require_once "Controllers/karyawanController.php";

// Uses the classes
use Controllers\KaryawanController;
use Utils\SanitizeInput;

$idKaryawan = isset($_GET["id"]) ? SanitizeInput::Santize(array($_GET["id"])) : null;

if (is_null($idKaryawan)) {
   header("Location: index.php");
   exit;
}

$getKaryawanById = KaryawanController::GetKaryawanById($idKaryawan[0]);

if (isset($_POST["deleteButton"])) {
   $resultDeleteKaryawan = KaryawanController::DeleteKaryawan($idKaryawan[0]);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Hapus data | Karyawan</title>

   <style>
      *,
      html {
         padding: 0;
         margin: 0;
         box-sizing: border-box;
      }

      body {
         background-color: #ddd;
      }

      .container {
         min-width: 100%;
         min-height: 100vh;
         display: flex;
         justify-content: center;
         align-items: center;
      }

      .container .box-content {
         padding: 2rem;
         border: 1px solid #fff;
         background-color: #fff;
         border-radius: 10px;
         display: grid;
         gap: 10px;
      }

      .box-content .content-title {
         margin-bottom: 1.3rem;
         display: grid;
         gap: 10px;
      }

      .content-title .title {
         font-family: 'Times New Roman', Times, serif;
         font-size: 2.5em;
         line-height: 1.3em;
         text-transform: capitalize;
         font-weight: 500;
         text-align: center;
         color: red;
      }

      .content-title .sub-title {
         font-family: Verdana, Geneva, Tahoma, sans-serif;
         font-size: 1.3em;
         font-weight: 400;
      }

      .content-title .title-name {
         text-transform: uppercase;
      }

      .content-action {
         display: flex;
         place-content: center;
         /* border: 1px solid green; */
      }

      .content-action .forms-action {
         display: grid;
         gap: 10px;
         padding: 10px;
         grid-template-columns: 1fr 1fr;
      }

      .content-action .button-action {
         padding: 10px;
         border: 1px solid black;
         outline: none;
         border-radius: 5px;
         font-family: 'Times New Roman', Times, serif;
         font-size: 1.45em;
      }

      .content-action .primary {
         text-decoration: none;
         color: #fff;
         background-color: green;
         cursor: pointer;
      }

      .content-action .danger {
         color: #fff;
         background-color: #ff1111;
         cursor: pointer;
      }
   </style>
</head>

<body>
   <main>
      <section class="container">
         <div class="box-content">

            <div class="content-title">
               <h4 class="title">Berbahaya</h4>
               <p class="sub-title" style="text-align: center;"><?= $resultDeleteKaryawan ?? null ?></p>
               <hr>
               <p class="sub-title">Apakah anda yakin akan menghapus</p>
               <span class="sub-title">karyawan: <b class="title-name"><?= $getKaryawanById[0][0] ?></b></span>
            </div>

            <div class="content-action">
               <form method="post" class="forms-action">
                  <a href="index.php" class="button-action primary">Kembali</a>
                  <button type="submit" name="deleteButton" class="button-action danger">Hapus</button>
               </form>
            </div>

         </div>
      </section>
   </main>
</body>

</html>