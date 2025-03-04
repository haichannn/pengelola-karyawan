<?php

class SanitizeInput {
   static public function Santize($DataInputed) {
      $sanitizeData = [];

      foreach ($DataInputed as $key => $value) {
         $santize = trim(htmlspecialchars($value, ENT_QUOTES));
         $sanitizeData[$key] = $santize;
      }

      return $sanitizeData;
   }
}

?>