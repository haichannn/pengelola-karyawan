<?php

namespace Controllers;

// Imported file and Class 
require "./Models/karyawanModel.php";
use Models\Karyawan as KaryawanModel;

class Karyawan extends KaryawanModel
{
    static public function GetAllKaryawan() {
        $GetAllDataKarywaan = new Karyawan();
        $ResultGetAllData = $GetAllDataKarywaan->GetAllData();
       
        // Jika data karyawan kosong 
        if (count($ResultGetAllData) === 0) {
            return false;
        }

        return $ResultGetAllData;
    }
}

