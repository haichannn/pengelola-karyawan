<?php

namespace Models;

// Imported file and Class 
require "./Config/database.php";
use Config\Database;

class KaryawanModel extends Database
{
   public function __construct()
   {
      $koneksiDb = new Database();
      $this->koneksi = $koneksiDb->koneksi;
   }

   protected function GetData(): array
   {
      $sqlSelectKaryawan = "SELECT karyawan.nama_lengkap, email, jabatan.nama_jabatan 
                            FROM karyawan JOIN jabatan ON karyawan.jabatan = jabatan.id
                           ";
      $resultSql = $this->koneksi->query($sqlSelectKaryawan);
      return $resultSql->fetch_all();
   }

   protected function InsertData($dataKaryawan)
   {
      $username = $dataKaryawan["username"];
      $email = $dataKaryawan["email"];
      $jenisKelamin = $dataKaryawan["jenisKelamin"];
      $jabatan = $dataKaryawan["jabatan"];
      $tanggalLahir = $dataKaryawan["tanggalLahir"];

      // Cari email berdasarkan nama email 
      $sqlSearchEmail = "SELECT id FROM karyawan WHERE email = '$email' ";
      $querySqlSearch = $this->koneksi->query($sqlSearchEmail);
      $resultTotalData = count($querySqlSearch->fetch_all());

      // jika user mencoba memasukan email sudah terdaftar
      if ($resultTotalData > 0) {
         return false;
      }

      $sqlInsert = "INSERT INTO karyawan (nama_lengkap,jenis_kelamin,tanggal_lahir,email,jabatan) VALUES ('$username','$jenisKelamin','$tanggalLahir','$email','$jabatan')";

      $this->koneksi->query($sqlInsert);

      return $this->koneksi->affected_rows;
   }

   public function __destruct()
   {
      $this->koneksi->close();
   }
}
