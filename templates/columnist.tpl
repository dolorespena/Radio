{include file={'header.tpl'}
    <table><tr>
        {foreach  item=columnist from=$columnists}
            <td><img src={$base_url_img}></td>
            <td><a href={$base_url_columnist}{$idColumnist}>{$columnist->nombre}</a></td>
            <td>{$columnist->profesion}</td>
            <td>{$columnist->descripcion}</td>
        {/foreach}
    </tr></table>
{include file='footer.tpl'}

