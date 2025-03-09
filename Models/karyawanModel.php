<?php

namespace Models;

require "query.php";
use Models\Query;
use Exception;

class KaryawanModel extends Query
{
   protected function indexQuery(string $queryInput)
   {
      $HitQuery = $this->koneksi->query($queryInput);
      return $HitQuery;
   }

   protected function GetData()
   {
      $sqlSelectData = self::indexQuery("SELECT karyawan.id, karyawan.nama_lengkap, email, jabatan.nama_jabatan 
      FROM karyawan JOIN jabatan ON karyawan.jabatan = jabatan.id
      ");

      return $sqlSelectData->fetch_all();
   }

   protected function GetDataById(int $idKaryawan): array
   {
      $sqlSelectById = self::indexQuery("SELECT nama_lengkap, jenis_kelamin, tanggal_lahir, email FROM karyawan WHERE id = $idKaryawan");
      return $sqlSelectById->fetch_all();
   }

   protected function InsertData($dataKaryawan)
   {
      $username = $dataKaryawan["username"];
      $email = $dataKaryawan["email"];
      $jenisKelamin = $dataKaryawan["jenisKelamin"];
      $jabatan = $dataKaryawan["jabatan"];
      $tanggalLahir = $dataKaryawan["tanggalLahir"];

      // Cari email berdasarkan nama email 
      $sqlSearchEmail = self::indexQuery("SELECT id FROM karyawan WHERE email = '$email' ");
      $resultTotalData = count($sqlSearchEmail->fetch_all());

      // jika user mencoba memasukan email sudah terdaftar
      if ($resultTotalData > 0) {
         return false;
      }

      self::indexQuery("INSERT INTO karyawan (nama_lengkap,jenis_kelamin,tanggal_lahir,email,jabatan) VALUES ('$username','$jenisKelamin','$tanggalLahir','$email','$jabatan')");

      return $this->koneksi->affected_rows;
   }

   protected function DeleteData($idKaryawan)
   {
      // cari data karyawan berdasarkan id 
      $sqlSelectDataById = self::GetDataById($idKaryawan);
      $resultDataFound = count($sqlSelectDataById);

      if ($resultDataFound > 0) { // jika data ketemu
         self::indexQuery("DELETE FROM karyawan WHERE id = $idKaryawan");

         return $this->koneksi->affected_rows;
      } else {
         return false;
      }
   }

   protected function UpdateData($idKaryawan, $dataKaryawan)
   {
      // cari data karyawan berdasarkan id
      $resultGetDataById = self::GetDataById($idKaryawan);
      $resultGetFound = count($resultGetDataById);

      // jika data tidak ketemu
      if ($resultGetFound == 0) {
         throw new Exception("data tidak diketahui !");
      }

      $namaLengkap = $dataKaryawan["namaLengkap"];
      $jenisKelamin = $dataKaryawan["jenisKelamin"];
      $tanggalLahir = $dataKaryawan["tanggalLahir"];
      $email = $dataKaryawan["email"];

      self::indexQuery("UPDATE karyawan SET nama_lengkap = '$namaLengkap', jenis_kelamin = '$jenisKelamin', tanggal_lahir = '$tanggalLahir', email = '$email' WHERE id = $idKaryawan");

      return $this->koneksi->affected_rows;
   }
}
