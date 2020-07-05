{include 'header.tpl'}

<div class= "cont-sup-admin">
    {if $esUser}
    <p class="saludoUsuario">{$saludo}{$username}!</p>
    {/if}

    <a class= "adminUsuario" href="admin/"> Volver a 'Columnistas'</a>
</div>

<h1>Área de administración</h1>
<h2 class="title2">Usuarios</h2>

<div class="adminColumnist">
    <table>
        <tr class="headertableColumnist">
            <th>Usuario</th>
            <th>E-mail</th>
            <th>¿Es Admin?</th>
        </tr>
        {foreach from=$users item=user}
            <tr>
                <td>{$user->username}</td>
                <td>{$user->email}</td>
                <td>{$user->admin}</td>
                <td class="editDelete"><a href="#">Hacer Admin</a></td>
                <td class="editDelete"><a href="#" >Eliminar</a></td>
            </tr>      
        {/foreach}
    </table>
</div>

{include 'footer.tpl'}
