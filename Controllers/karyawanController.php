<?php

namespace Controllers;

// Imported file and Class 
require "./Models/karyawanModel.php";
require "./utils/santitizeInput.php";
require "./utils/parser.php";

use Models\KaryawanModel;
use SanitizeInput;

class KaryawanController extends KaryawanModel
{
   static public function GetAllKaryawan()
   {

      $GetAllDataKarywaan = new KaryawanModel();
      $ResultGetAllData = $GetAllDataKarywaan->GetData();

      // Jika data karyawan kosong 
      if (count($ResultGetAllData) === 0) {
         return false;
      }

      return $ResultGetAllData;
   }

   static public function InsertKaryawan($dataInputed)
   {
      $resultSanitize = SanitizeInput::Santize($dataInputed);
      $InsertDataKaryawan = new KaryawanModel();
      $resultInsertData = $InsertDataKaryawan->InsertData($resultSanitize);
      
      return $resultInsertData;
   }
}
