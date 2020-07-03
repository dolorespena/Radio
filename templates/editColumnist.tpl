{include 'header.tpl'}

{if $esUser}
<p class="saludoUsuario">{$saludo}{$username}!</p>
{/if}

<h1>{$title}</h1>

<form action="admin/columnist/update/{$old->id_columnista}" method="post" class="formEdit">
    
    <fieldset>
        <legend>Agregar Columnista</legend>

        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" value="{$old->nombre}">

        <label for="profesion">Profesión</label>
        <input type="text" name="profesion" value="{$old->profesion}">

        <label for="descripcion">Descripcion</label>
        <input type="text" name="descripcion" value="{$old->descripcion}">

        <label for="imagen"></label>
        <select name='imagen'>
            <option value={$old->url_imagen}>Misma imagen</option>
            <option value='img/profile/muestra1.jpg'>Imagen 1</option>
            <option value='img/profile/muestra2.jpg'>Imagen 2</option>
            <option value='img/profile/muestra3.jpg'>Imagen 3</option>
            <option value='img/profile/muestra4.jpg'>Imagen 4</option>
            <option value='img/profile/muestra5.jpg'>Imagen 5</option>
            <option value='img/profile/muestra6.jpg'>Imagen 6</option>
            <option value='img/profile/muestra7.jpg'>Imagen 7</option>  
        </select>

        <button type='submit'>Editar</button>
    </fieldset>
</form>
    
</body>
</html>

{include 'footer.tpl'}
