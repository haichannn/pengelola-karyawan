<?php
namespace Models;

// Imported files
require "query.php";

// Uses the classes
use Models\Query;
use Exception;

class KaryawanModel extends Query
{
   protected function indexQuery(string $queryInput)
   {
      $HitQuery = $this->koneksi->query($queryInput);
      return $HitQuery;
   }

   protected function GetData(): array
   {
      $sqlSelectData = self::indexQuery("SELECT karyawan.id, karyawan.nama_lengkap, email, jabatan.nama_jabatan 
      FROM karyawan JOIN jabatan ON karyawan.jabatan = jabatan.id
      ");

      $resultSqlSelect = $sqlSelectData->fetch_all();

      if (count($resultSqlSelect) === 0) {
         throw new Exception("Data sedang tidak tersedia !");
      }

      return $resultSqlSelect;
   }

   protected function GetDataById(int $idKaryawan): array
   {
      $sqlSelectById = self::indexQuery("SELECT nama_lengkap, jenis_kelamin, tanggal_lahir, email FROM karyawan WHERE id = $idKaryawan");
      return $sqlSelectById->fetch_all();
   }

   protected function InsertData(array $dataKaryawan): int
   {
      $username = $dataKaryawan["username"];
      $email = $dataKaryawan["email"];
      $jenisKelamin = $dataKaryawan["jenisKelamin"];
      $jabatan = $dataKaryawan["jabatan"];
      $tanggalLahir = $dataKaryawan["tanggalLahir"];

      // Cari email berdasarkan nama email 
      $sqlSearchEmail = self::indexQuery("SELECT id FROM karyawan WHERE email = '$email' ");

      // jika user mencoba memasukan email sudah terdaftar
      if (count($sqlSearchEmail->fetch_all()) > 0) {
         throw new Exception("Email sudah terdaftar, gunakan email lain !");
      }

      self::indexQuery("INSERT INTO karyawan (nama_lengkap,jenis_kelamin,tanggal_lahir,email,jabatan) VALUES ('$username','$jenisKelamin','$tanggalLahir','$email','$jabatan')");
      return $this->koneksi->affected_rows;
   }

   protected function DeleteData(int $idKaryawan): int
   {
      // cari data karyawan berdasarkan id 
      $sqlSelectDataById = self::GetDataById($idKaryawan);

      if (count($sqlSelectDataById) > 0) { // jika data ditemukan
         self::indexQuery("DELETE FROM karyawan WHERE id = $idKaryawan");
         return $this->koneksi->affected_rows;
      } else {
         throw new Exception("Data tidak diketahui !");
      }
   }

   protected function UpdateData(int $idKaryawan, array $dataKaryawan): int
   {
      // cari data karyawan berdasarkan id
      $resultGetDataById = self::GetDataById($idKaryawan);

      // jika data tidak ketahui
      if (count($resultGetDataById) == 0) {
         throw new Exception("Data tidak diketahui !");
      }

      $namaLengkap = $dataKaryawan["namaLengkap"];
      $jenisKelamin = $dataKaryawan["jenisKelamin"];
      $tanggalLahir = $dataKaryawan["tanggalLahir"];
      $email = $dataKaryawan["email"];

      self::indexQuery("UPDATE karyawan SET nama_lengkap = '$namaLengkap', jenis_kelamin = '$jenisKelamin', tanggal_lahir = '$tanggalLahir', email = '$email' WHERE id = $idKaryawan");
      return $this->koneksi->affected_rows;
   }
}
