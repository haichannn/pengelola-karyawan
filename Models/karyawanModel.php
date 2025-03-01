<?php

namespace Models;

// Imported file and Class 
require "./Config/database.php";
use Config\Database;

class Karyawan extends Database {
    public function __construct()
    {
        $koneksiDb = new Database();
        $this->koneksi = $koneksiDb->koneksi;
    }

    public function GetAllData(): array
    {
        $sqlSelectKaryawan = "SELECT karyawan.nama_lengkap, email, jabatan.nama_jabatan 
                              FROM karyawan JOIN jabatan ON karyawan.jabatan = jabatan.id
                             ";
        $resultSql = $this->koneksi->query($sqlSelectKaryawan);

        return $resultSql->fetch_all();
    }

    public function __destruct()
    {
        $this->koneksi->close();
    }
}


?>