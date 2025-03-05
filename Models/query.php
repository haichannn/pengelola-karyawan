<?php

namespace Models;

require "./Config/database.php";
use Config\Database;

abstract class Query extends Database{
  protected $koneksi;

  public function __construct()
   {
      $koneksiDb = new Database();
      $this->koneksi = $koneksiDb->koneksi;
   }

   abstract protected function indexQuery(string $queryInput);

   public function __destruct()
   {
      $this->koneksi->close();
   }
}
