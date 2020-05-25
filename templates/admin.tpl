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
            <td><a href="editar/columnista/{$columnist->id_columnista}">Ver</a></td>
            <td><a href="eliminar/columnista/{$columnist->id_columnista}">Eliminar</a></td>
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
            <td>{$podcast->id_columnista_fk}</td>
            <td><a href="editar/podcast/{$podcast->id_podcast}">Ver</a></td>
            <td><a href="eliminar/podcast/{$podcast->id_podcast}">Eliminar</a></td>
        </tr>      
    {/foreach}
</table>
