{include 'header.tpl'}

{if $esUser}
<p class="saludoUsuario">{$saludo}{$username}!</p>
{/if}

<h1>{$title}</h1>

<form action="admin/columnist/update/{$old->id_columnista}" method="post" class="formEdit" enctype="multipart/form-data">
    
    <fieldset>
        <legend>Agregar Columnista</legend>

        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" value="{$old->nombre}">

        <label for="profesion">Profesión</label>
        <input type="text" name="profesion" value="{$old->profesion}">

        <label for="descripcion">Descripcion</label>
        <input type="text" name="descripcion" value="{$old->descripcion}">

        <label for="imagen"></label>
        <input type="file" name="imagen" id="imagen" accept= image/*>

        <input type="hidden" name="old_imagen" value="{$old->url_imagen}">

        <button type='submit'>Editar</button>
    </fieldset>
</form>
    
</body>
</html>

{include 'footer.tpl'}
