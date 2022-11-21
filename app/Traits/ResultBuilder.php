<?php

namespace App\Traits;


/**
 * 
 */
trait ResultBuilder
{
     public function success($message, $data, $code)
     {
          $result = [
               'success' => true,
               'code' => $code,
               'message' => $message,
               'data' => $data
          ];
          return $result;
     }

     public function error($message, $code)
     {
          $result = [
               'success' => false,
               'code' => $code,
               'message' => $message,
          ];
          return $result;
     }
}
