<?php

class APIView {

    /**
     * Devuelve un arreglo en formato JSON
     */
    public function responce($data){
        header("Content_Type: application/json");  //avisa q esta trabajando con json
        echo json_encode($data);
    }
}