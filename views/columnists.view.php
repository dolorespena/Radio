<?php

Class ColumnistsView{

    public function showColumnists($columnists){

        echo ("<table><tr>");
            foreach ($columnists as $columnist){
                $idColumnist = $columnist->id_columnista;
                echo("<td><img src=" . BASE_URL . $columnist->url_imagen ."></td><td><a href='columnistas/" . $idColumnist . "'>" . $columnist->nombre . "</a></td><td>" . $columnist->profesion . "</td><td>" . $columnist->descripcion . "</td></tr>");
            }
        echo ("</table>");

       

    }

   
}