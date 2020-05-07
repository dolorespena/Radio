<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>

<?php

Class PodcastsView{

    public function showPodcasts($podcasts){
        
       $html = $this->showheader();
       echo($html);

        $columnist = $podcasts[0]->columnista; //Saco del arreglo el nombre del columnista 
        echo ("<h1> Todas los podcasts de " . $columnist ."</h1>");

        foreach ($podcasts as $podcast){ //Este ciclo se va a realizar por cada objeto del arreglo.
            echo ("<h2>" . $podcast->nombre . "</h2>"); // Título del Podcast
            echo("<p>" . $podcast->fecha . " - " . $podcast->duracion . " min</p>"); //Fecha y duración
            echo("<p>" . $podcast->descripcion . "</p>"); // Descripcion del podcast
            echo("<audio controls autoplay><source src='"  . BASE_URL . $podcast->url_audio . "' type='audio/ogg; codecs=vorbis'>Your browser does not support the element.</audio>");
        
        }
    }

    private function showheader(){

        echo (
        '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Columnistas</title>
            </head>
            <body>
                
            </body>
        </html>');



    }

}