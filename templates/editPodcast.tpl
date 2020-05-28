{include 'header.tpl'}

{if $esAdmin}
<p>{$saludo}{$username}!</p>
{/if}

<h1>{$title}</h1>

<form action="admin/update/podcast/{$old->id_podcast}" method="post">
    
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
        <select name='audio'>
            <option value='{$old->url_audio}'>Mismo audio</option>
            <option value='audio/muestra1.ogg'>Audio 1</option>
            <option value='audio/muestra2.ogg'>Audio 2</option>
            <option value='audio/muestra3.ogg'>Audio 3</option>
            <option value='audio/muestra4.ogg'>Audio 4</option>
            <option value='audio/muestra5.ogg'>Audio 5</option>
            <option value='audio/muestra6.ogg'>Audio 6</option>
            <option value='audio/muestra7.ogg'>Audio 7</option>  
        </select>

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

{include 'footer.tpl'}