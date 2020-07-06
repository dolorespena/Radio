{include 'header.tpl'}

<div class= "cont-sup-admin">
    {if $esUser}
    <p class="saludoUsuario">{$saludo}{$username}!</p>
    <a class= "adminUsuario" href="admin/">Área de Administración</a>
    {/if}
</div>

<h1>{$title}</h1>

<form action="admin/podcast/update/{$old->id_podcast}" method="post" class="formEdit" enctype="multipart/form-data">
    
    <fieldset>
        <legend>Agregar Podcast</legend>

        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" value="{$old->nombre}">

        <label for="columnista">Columnista</label>
        <select name="columnista" id="columnista">
        {foreach from=$listColumnists item=columnist}
            <option value={$columnist->id_columnista}>{$columnist->nombre}</option>         
        {/foreach} 
        </select>

        <label for="descripcion">Descripcion</label>
        <textarea name="descripcion" id="descripcion">{$old->descripcion}</textarea>

        <label for="audio">Audio</label>
        <input type="file" name="audio" id="podcast" accept= audio/*>

        <input type="hidden" name="old_audio" value="{$old->url_audio}">
        
        <label for="fecha">Fecha</label>
        <input type="date" name="fecha" id="fecha" value="{$old->fecha}">

        <label for="duracion">Duración</label>
        <input type="number" name="duracion" id="duracion" min=1 value="{$old->duracion}">

        <label for="etiqueta">Etiqueta</label>
        <input type="text" name="etiqueta" value="{$old->tag}">

        <label for="invitado">Invitado</label>
        <input type="text" name="invitado" placeholder="(opcional)" value="{$old->invitado}">

        <button type='submit'>Editar Podcast</button>
    </fieldset>
</form>
<a href="admin">Volver</a>
{include 'footer.tpl'}