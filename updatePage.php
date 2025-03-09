<?php
// Imported files
require "Controllers/karyawanController.php";
require_once "utils/santitizeInput.php";

// Uses the classes
use Controllers\KaryawanController;
use Utils \ {
  SanitizeInput,
  Parser
};

$idKaryawan = isset($_GET["id"]) ? SanitizeInput::Santize(array($_GET["id"]))[0] : null;

if (is_null($idKaryawan)) {
  header("Location: index.php");
  exit;
}

// ambil data karyawan berdasarkan id
$resultGetKaryawan = KaryawanController::GetKaryawanById($idKaryawan)[0];

if (isset($_POST["updateButton"])) {
  $resultUpdateKaryawan = KaryawanController::UpdateKaryawan($idKaryawan, $_POST);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Update data | karyawan</title>
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
      place-items: center;
      padding-top: 1rem;
    }

    .box {
      display: grid;
      gap: 5px;
      padding: 1.3rem;
      width: 100%;
    }

    .box .content {
      margin-bottom: 2.5rem;
    }

    .box .content .title {
      font-size: 2.5em;
      font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
      line-height: 2em;
      text-transform: capitalize;
    }

    .box .content .subtitle {
      font-size: 1.3em;
      font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
      line-height: 2em;
      text-transform: capitalize;
    }

    .box .group {
      display: grid;
      gap: 10px;
      margin-bottom: 2.5rem;
    }

    .box .group .box-input-jenisKelamin {
      display: grid;
      gap: 5px;
    }

    .box .group .box-input-jenisKelamin span {
      font-family: Arial, Helvetica, sans-serif;
      font-size: 1.3em;
      font-weight: 400;
      color: #000000;
      text-transform: capitalize;
    }

    .box .group label {
      font-family: Arial, Helvetica, sans-serif;
      font-size: 1.6em;
      font-weight: 400;
      color: #000000;
      text-transform: capitalize;
    }

    .box .group input {
      font-size: 1.3em;
    }

    .box .group input,
    button {
      outline: none;
      border: 1px solid #dddddd;
      padding: .8rem;
      border-radius: 5px;
    }

    .box .group .container-button {
      display: flex;
      justify-content: flex-end;
      align-items: center;
      margin-top: 1.5rem;
      gap: 10px;
    }

    .box .group .container-button a {
      border: 1px solid #dddddd;
      padding: .8rem;
      border-radius: 5px;
      background-color: #6c757d;
      color: #ffffff;
      text-decoration: none;
      font-size: 1.1em;
    }

    .box .group .container-button a:hover {
      color: #ddd;
      transition: .3s ease;
    }

    .box .group .container-button button {
      background-color: #0d6efd;
      color: #ffffff;
      font-size: 1.1em;
    }

    .box .group .container-button button:hover {
      color: #ddd;
      transition: .3s ease;
    }

    /* Responsive Breakpoints */
    @media screen and (min-width: 768px) {
      .box {
        width: 60%;
      }
    }

    @media screen and (min-width: 992px) {
      .box {
        width: 65%;
      }
    }
  </style>
</head>

<body>
  <main>
    <section class="container">
      <form class="box" method="post">
        <div class="content">
          <p class="title">Update data</p>
          <span class="subtitle"><?= $resultUpdateKaryawan ?? null ?></span>
        </div>

        <div class="group">
          <label for="namaLengkapInput">Nama lengkap</label>
          <input type="text" value="<?= $resultGetKaryawan[0] ?>" name="namaLengkap" id="namaLengkapInput" placeholder="John doe" required />
        </div>

        <div class="group">
          <label>Jenis kelamin</label>
          <div class="box-input-jenisKelamin">
            <div>
              <input type="radio" name="jenisKelamin" value="Pria" id="priaRadio" onclick="pilihRadio(this)" required <?= ($resultGetKaryawan[1] == "Pria") ? 'checked' : null ?> />
              <span for="priaRadio">Pria</span>
            </div>
            <div>
              <input type="radio" name="jenisKelamin" value="Perempuan" id="perempuanRadio" onclick="pilihRadio(this)" required <?= ($resultGetKaryawan[1] == "Perempuan") ? 'checked' : null ?> />
              <span for="perempuanRadio">Perempuan</span>
            </div>
          </div>
        </div>

        <div class="group">
          <label for="tanggalLahirInput">Tanggal lahir</label>
          <input type="date" name="tanggalLahir" value="<?= Parser::ParserDate($resultGetKaryawan[2]) ?>" id="tanggalLahirInput" required>
        </div>

        <div class="group">
          <label for="emailInput">Email</label>
          <input type="email" name="email" value="<?= $resultGetKaryawan[3] ?>" id="emailInput" pattern="[a-zA-Z0-9._%+-]+@(gmail|yahoo|outlook|ymail)\.com" placeholder="example@gmail.com" required />
        </div>

        <div class="group">
          <div class="container-button">
            <div>
              <a href="index.php" role="button">Kembali</a>
            </div>
            <div>
              <button type="submit" name="updateButton">Update Data</button>
            </div>
          </div>
        </div>
      </form>
    </section>
  </main>

  <script>
    // fungsi untuk pilih button radio hanya boleh 1 yang di klik
    function pilihRadio(radio) {
      var radios = document.getElementsByName('jenisKelamin')

      for (var i = 0; i < radios.length; i++) {
        if (radios[i] !== radio) {
          radios[i] = false
        }
      }
    }
  </script>
</body>

</html>