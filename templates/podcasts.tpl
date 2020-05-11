{include 'header.tpl'}


<h1> Todos los podcasts de {$columnista}</h1>

{foreach $podcasts item=podcast} {* Este ciclo se va a realizar por cada objeto del arreglo*}
    <h2> {$podcast->nombre} </h2> {* Título del Podcast*}
    <p> {$podcast->fecha}  - {$podcast->duracion} min </p> {*Fecha y duración*}
    <p> {$podcast->descripcion} </p> {*Descripcion del podcast*}
    <audio controls autoplay><source src= {$base_url} {$podcast->url_audio} 
    type='audio/ogg' codecs='vorbis'>Your browser does not support the element.</audio> 
{/foreach}


</body></html>