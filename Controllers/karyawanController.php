<?php
namespace Controllers;

// Imported files
require "./Models/karyawanModel.php";
require "./utils/santitizeInput.php";
require "./utils/parser.php";

// Uses the classes
use Models\KaryawanModel;
use Utils \ {
   Parser,
   SanitizeInput
};
use Exception;

class KaryawanController extends KaryawanModel
{
   static public function GetAllKaryawan(): array|string
   {
      $getAllDataKaryawan = new KaryawanModel();

      try {
         return $getAllDataKaryawan->GetData();
      } catch (Exception $e) {
         return $e->getMessage();
      }
   }

   static public function GetKaryawanById(string $idRawKaryawan): array
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

   static public function InsertKaryawan(array $dataInputed): int|string
   {
      $resultSanitize = SanitizeInput::Santize($dataInputed);
      $InsertDataKaryawan = new KaryawanModel();
      
      try {
         return $InsertDataKaryawan->InsertData($resultSanitize);
      } catch (Exception $e) {
         return $e->getMessage();
      }
   }

   static public function DeleteKaryawan(string $idRawKaryawan): string
   {
      // konversi string ke number
      $idKaryawan = Parser::ParserToInt($idRawKaryawan);

      if ($idKaryawan == 0) {
         header("Location: index.php");
         return false;
      }

      $deleteKaryawan = new KaryawanModel();
      
      try {
         $deleteKaryawan->DeleteData($idKaryawan);
         echo "
               <script>
                  setTimeout(() => {
                     document.location.href = 'index.php';
                  }, 1500);   
               </script>
            ";
         return "Data berhasil dihapus";
      } catch (Exception $e) {
         return $e->getMessage();
      }
   }

   static public function UpdateKaryawan(string $idRawKaryawan, array $dataInputed): string|null
   {
      $idKaryawan = Parser::ParserToInt($idRawKaryawan);
      $updateDataKaryawan = new KaryawanModel();

      try {
         $resultUpdateKaryawan = $updateDataKaryawan->UpdateData($idKaryawan, SanitizeInput::Santize($dataInputed));

         if ($resultUpdateKaryawan == 1) {
            return "Data berhasil diupdate !";
         }

         return null;

      } catch (Exception $e) {
         return $e->getMessage();
      }
   }
}
