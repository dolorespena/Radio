{include 'header.tpl'}

{if $esUser}
<p class="saludoUsuario">{$saludo}{$username}!</p>
{/if}

    <table class="table_columnist">
        {foreach $columnists item=columnist}
            <tr>
                <td><img src="{$base_url}{$columnist->path}"></td>
                <td class = "resaltado"><a href= "{$base_url}{$url_columnist}{$columnist->id_columnista}"><b>{$columnist->nombre}</b></a></td>
                <td>{$columnist->profesion}</td>
                <td>{$columnist->descripcion}</td>
            </tr>
        {/foreach}
    </table>
{include 'footer.tpl'}

