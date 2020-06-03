{include 'header.tpl'}

{if $esAdmin}
<p class="saludoUsuario">{$saludo}{$username}!</p>
{/if}

<h1>Área de administración</h1>
<h2 class="title2">Columnistas</h2>

<div class="adminColumnist">
    <table>
        <tr class="headertableColumnist">
            <th>Nombre</th>
            <th>Profesión</th>
            <th>Descripción</th>
        </tr>
        {foreach from=$columnists item=columnist}
            <tr>
                <td>{$columnist->nombre}</td>
                <td>{$columnist->profesion}</td>
                <td>{$columnist->descripcion}</td>
                <td class="editDelete"><a href="admin/columnist/edit/{$columnist->id_columnista}">Editar</a></td>
                <td class="editDelete"><a href="admin/columnist/delete/{$columnist->id_columnista}" >Eliminar</a></td>
                <td class="editDelete"><a href="admin/podcast/view/{$columnist->id_columnista}">Ver Podcast</a></td>
            </tr>      
        {/foreach}
    </table>

    <form action="admin/columnist/add/" method="post" class="addColumnist">
        
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
</div>

{include 'footer.tpl'}
