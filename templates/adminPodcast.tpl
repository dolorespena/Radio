{include 'header.tpl'}

{if $esAdmin}
<p class="saludoUsuario">{$saludo}{$username}!</p>
{/if}

<h1>Área de administración</h1>

<h2 class="title2">Podcasts de {$podcasts[0]->columnista}</h2>
<div class="adminPodcast">
    <table>
        <tr>
            <th>Nombre</th>
            <th>Fecha</th>
            <th>Columnista</th>
        </tr>
        {foreach from=$podcasts item=podcast}
            <tr>
                <td>{$podcast->nombre}</td>
                <td>{$podcast->fecha}</td>
                <td>{$podcast->columnista}</td>
                <td class="editDelete"><a href="admin/podcast/edit/{$podcast->id_podcast}" >Editar</a></td>
                <td class="editDelete"><a href="admin/podcast/delete/{$podcast->id_podcast}">Eliminar</a></td>
            </tr>      
        {/foreach}
    </table>

    <form action="admin/podcast/add/" method="post" class="addPodcast">
        
        <fieldset>
            <legend>Agregar Podcast</legend>

            <label for="nombre">Nombre</label>
            <input type="text" name="nombre">

            <label for="columnista">Columnista</label>
            <select name="columnista" id="columnista">
            {foreach from=$columnists item=columnist}
                <option value={$columnist->id_columnista}>{$columnist->nombre}</option>         
            {/foreach} 
            </select>

            <label for="descripcion">Descripcion</label>
            <textarea name="descripcion" id="descripcion"></textarea>

            <label for="audio">Audio</label>
            <select name='audio'>
                <option value='audio/muestra1.ogg'>Audio 1</option>
                <option value='audio/muestra2.ogg'>Audio 2</option>
                <option value='audio/muestra3.ogg'>Audio 3</option>
                <option value='audio/muestra4.ogg'>Audio 4</option>
                <option value='audio/muestra5.ogg'>Audio 5</option>
                <option value='audio/muestra6.ogg'>Audio 6</option>
                <option value='audio/muestra7.ogg'>Audio 7</option>  
            </select><br>

            <label for="fecha">Fecha</label>
            <input type="date" name="fecha" id="fecha">

            <label for="duracion">Duración</label>
            <input type="number" name="duracion" id="duracion" min=1>

            <label for="etiqueta">Etiqueta</label>
            <input type="text" name="etiqueta">

            <label for="invitado">Invitado</label>
            <input type="text" name="invitado" placeholder="(opcional)">

            <button type='submit'>Añadir</button>
        </fieldset>
    </form>
</div>
{include 'footer.tpl'}