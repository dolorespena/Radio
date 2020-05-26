{include 'header.tpl'}

<h1>Área de administración</h1>

<h2>Columnistas</h2>

<table>
    <tr>
        <th>Nombre</th>
        <th>Profesión</th>
        <th>Descripción</th>
    </tr>
    {foreach from=$columnists item=columnist}
        <tr>
            <td>{$columnist->nombre}</td>
            <td>{$columnist->profesion}</td>
            <td>{$columnist->descripcion}</td>
            <td><a href="admin/edit/columnist/{$columnist->id_columnista}">Editar</a></td>
            <td><a href="admin/delete/columnist/{$columnist->id_columnista}">Eliminar</a></td>
        </tr>      
    {/foreach}
</table>


<h2>Podcasts</h2>

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
            <td><a href="admin/edit/podcast/{$podcast->id_podcast}">Editar</a></td>
            <td><a href="admin/delete/podcast/{$podcast->id_podcast}">Eliminar</a></td>
        </tr>      
    {/foreach}
</table>

<form action="admin/add/columnist/" method="post">
    
    <fieldset>
        <legend>Agregar Columnista</legend>

        <label for="nombre">Nombre</label>
        <input type="text" name="nombre">

        <label for="profesion">Profesión</label>
        <input type="text" name="profesion">

        <label for="descripcion">Descripcion</label>
        <input type="text" name="descripcion">

        <label for="imagen"></label>
        <select name='imagen'>
            <option value='img/profile/muestra1.jpg'>Imagen 1</option>
            <option value='img/profile/muestra2.jpg'>Imagen 2</option>
            <option value='img/profile/muestra3.jpg'>Imagen 3</option>
            <option value='img/profile/muestra4.jpg'>Imagen 4</option>
            <option value='img/profile/muestra5.jpg'>Imagen 5</option>
            <option value='img/profile/muestra6.jpg'>Imagen 6</option>
            <option value='img/profile/muestra7.jpg'>Imagen 7</option>  
        </select>

        <button type='submit'>Añadir</button>
    </fieldset>
</form>

<form action="admin/add/podcast/" method="post">
    
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


