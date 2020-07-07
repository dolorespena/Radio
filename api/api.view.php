<?php

class APIView {

    /**
     * Devuelve un arreglo en formato JSON
     */
    public function response($data, $status){
        header("Content_Type: application/json");  //avisa q esta trabajando con json
        header("HTTP/1.1 " . $status . " " . $this->_requestStatus($status));// codigo HTTP + codigo(200,404,etc) + el msj del codigo
        echo json_encode($data);
    }

    // Asocia un msj de respuesta a un mjs HTTP
    private function _requestStatus($code){
        $status = array(
          200 => "OK",
          404 => "Not found",
          500 => "Internal Server Error"
        );
        return (isset($status[$code]))? $status[$code] : $status[500];
    }
}