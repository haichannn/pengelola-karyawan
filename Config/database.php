<?php

namespace Config;

use mysqli;

class Database
{
    private $username = "root";
    private $password = "root";
    private $database_name = "project-pengelola-karyawan";
    protected $koneksi;

    public function __construct()
    {
        $koneksiDatabase = new mysqli(
            "localhost",
            $this->username,
            $this->password,
            $this->database_name
        );

        $this->koneksi = $koneksiDatabase;
    }
}
