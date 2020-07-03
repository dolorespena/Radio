{include 'header.tpl'}

    {if $esUser}
    <p class="saludoUsuario">{$saludo}{$username}!</p>
    {/if}

    <div class= "box-podcast">
        <h2 class="titulo-podcast"> {$podcast->nombre} </h2> {* Título del Podcast*}
        <p class= "bajada-podcast"> {$podcast->fecha}  - {$podcast->duracion} min </p> {*Fecha y duración*}
        <p class= "descripcion-podcast"> {$podcast->descripcion} </p> {*Descripcion del podcast*}
        <audio controls ><source src= "{$base_url}{$podcast->url_audio}" type='audio/ogg' codecs='vorbis'>Your browser does not support the element.</audio> 
    </div> 
    {if $esUser}
        <form method="POST" action="comentario/{$podcast->id_podcast}/{$id_user}" class="comentario">
            <textarea name="comentario"></textarea>
            <select name="valoracion">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <button type="submit">Enviar</button>
        </form>
    {/if}
<script src="js/main.js"></script>
{include 'footer.tpl'}