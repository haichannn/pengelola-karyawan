<?php

namespace Controllers;

require "./Models/karyawanModel.php";
require "./utils/santitizeInput.php";
require "./utils/parser.php";

use Models\KaryawanModel;
use Utils \ {
   Parser,
   SanitizeInput
};

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

   static public function GetKaryawanById($idRawKaryawan)
   {
      // konversi string ke number
      $idKaryawan = Parser::ParserToInt($idRawKaryawan);

      if ($idKaryawan == 0) {
         header("Location: index.php");
         return false;
      }

      $GetDataById = new KaryawanModel();
      return $GetDataById->GetDataById($idKaryawan);
   }

   static public function InsertKaryawan($dataInputed)
   {
      $resultSanitize = SanitizeInput::Santize($dataInputed);
      $InsertDataKaryawan = new KaryawanModel();
      return $InsertDataKaryawan->InsertData($resultSanitize);
      
   }

   static public function DeleteKaryawan($idRawKaryawan)
   {
      // konversi string ke number
      $idKaryawan = Parser::ParserToInt($idRawKaryawan);

      if ($idKaryawan == 0) {
         header("Location: index.php");
         return false;
      }

      $deleteKaryawan = new KaryawanModel();
      $resultDeletekaryawan = $deleteKaryawan->DeleteData($idKaryawan);

      if ($resultDeletekaryawan == 1) {
         echo "data berhasil dihapus";
         echo "
               <script>
                  setTimeout(() => {
                     document.location.href = 'index.php';
                  }, 2000);   
               </script>
            ";
      } else {
         echo "Gagal, data tidak ditemukan";
         echo "
         <script>
            setTimeout(() => {
               document.location.href = 'index.php';
            }, 2000);   
         </script>
      ";
      }
   }
}
