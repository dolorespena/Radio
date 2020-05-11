{include 'header.tpl'}
    <table>
        {foreach $columnists item=columnist}
        <tr>
            <td><img src="{$base_url}{$columnist->url_imagen}"></td>
            <td><a href= "{$base_url}{$url_columnist}{$columnist->id_columnista}">{$columnist->nombre}</a></td>
            <td>{$columnist->profesion}</td>
            <td>{$columnist->descripcion}</td>
        </tr>
   
        {/foreach}
      
    </table>
{include 'footer.tpl'}

