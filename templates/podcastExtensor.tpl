{include 'header.tpl'}

<div class= "cont-sup-admin">
    {if $esUser}
    <p class="saludoUsuario">{$saludo}{$username}!</p>
    <a class= "adminUsuario" href="admin/">Área de Administración</a>
    {/if}
</div>

    <div class= "box-podcast">
        <h2 class="titulo-podcast"> {$podcast->nombre} </h2> {* Título del Podcast*}
        <p class= "bajada-podcast"> {$podcast->fecha}  - {$podcast->duracion} min </p> {*Fecha y duración*}
        <p class= "descripcion-podcast"> {$podcast->descripcion} </p> {*Descripcion del podcast*}
        <audio controls ><source src= "{$base_url}{$podcast->url_audio}" type='audio/ogg' codecs='vorbis'>Your browser does not support the element.</audio> 
    </div> 
    <div class="comentarios">
        <form method="POST" class="comentario" id="formComment">
            <input type="hidden" id="id_podcast" value="{$podcast->id_podcast}" >
            <input type="hidden" id="id_user" value="{$id_user}">
            {if $esUser}
                <textarea name="comentario" id="comentario"></textarea>
                <select name="valoracion" id=valoracion>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <button type="submit" class="button">Enviar</button>
                <p id="msjError"></p>
            {/if}
        </form>
    </div>
    {include 'vue.js/comments.vue'}
    <a class="btn-error" href="{$base_url}">Volver</a>
    <script src="js/formComment.js"></script>
{include 'footer.tpl'}