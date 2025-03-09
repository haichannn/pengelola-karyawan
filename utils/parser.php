<?php
namespace utils;

class Parser
{
   static public function ParserToInt(string $string)
   {
      return intval($string);
   }

   static public function ParserDate($date)
   {
      // format date YY-MM-DD
      return date("Y-m-d", strtotime($date));
   }
}
