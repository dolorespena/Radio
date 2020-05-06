<?php

Class ColumnistsView{

    public function showColumnists($columnists){

        echo ("<table><tr>");

        foreach ($columnists as $columnist){
            echo("<td>" . $columnist->nombre . "</td><td>" . $columnist->profesion . "</td><td>" . $columnist->descripcion . "</td><td><img src=" . BASE_URL . $columnist->url_imagen ."></td></tr>");
        }

        echo ("</table>");

       

    }

   
}