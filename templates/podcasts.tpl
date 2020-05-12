{include 'header.tpl'}

<h1 class= "titulo-ppal-podcasts"> Todos los podcasts de {$columnista}</h1>

<div class="contenedor-ppal-podcasts"> 

{foreach $podcasts item=podcast} {* Este ciclo se va a realizar por cada objeto del arreglo*}
    <div class= "box-podcast">
        <h2 class="titulo-podcast"> {$podcast->nombre} </h2> {* Título del Podcast*}
        <p class= "bajada-podcast"> {$podcast->fecha}  - {$podcast->duracion} min </p> {*Fecha y duración*}
        <p class= "descripcion-podcast"> {$podcast->descripcion} </p> {*Descripcion del podcast*}
        <audio controls autoplay><source src= "{$base_url}{$podcast->url_audio}"
        type='audio/ogg' codecs='vorbis'>Your browser does not support the element.</audio> 
    </div> {* cierre box-podcast *}
{/foreach}

</div> {* Cierre contenedor-principal*}


</body></html>