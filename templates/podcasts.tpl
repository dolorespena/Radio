{include 'header.tpl'}

    <div class= "cont-sup-admin">
        {if $esUser}
        <p class="saludoUsuario">{$saludo}{$username}!</p>
        <a class= "adminUsuario" href="admin/">Área de Administración</a>
        {/if}
    </div>

    <h1 class= "titulo-ppal-podcasts"> Todos los podcasts de {$columnista}</h1>
     <div class="images">
        {foreach $images as $image}
            <img src="{$image->path}">
        {/foreach}
    </div>
    <div class="contenedor-ppal-podcasts"> 
        
        {foreach $podcasts item=podcast} {* Este ciclo se va a realizar por cada objeto del arreglo*}
            <div class= "box-podcast">
                <h2 class="titulo-podcast"> {$podcast->nombre} </h2> {* Título del Podcast*}
               
                <p class= "bajada-podcast"> {$podcast->fecha}  - {$podcast->duracion} min </p> {*Fecha y duración*}
                <div class="descript">
                    <p class= "descripcion-podcast"> {$podcast->descripcion|truncate: 100}</p> {*Descripcion del podcast*}
                    <a href="podcast/{$podcast->id_podcast}" class="ver-mas">Ver más</a>
                </div>
                <audio controls ><source src= "{$base_url}{$podcast->url_audio}"
                type='audio/ogg' codecs='vorbis'>Your browser does not support the element.</audio> 
            </div> {* cierre box-podcast *}
        {/foreach}
    </div> {* Cierre contenedor-principal*}

{include 'footer.tpl'}