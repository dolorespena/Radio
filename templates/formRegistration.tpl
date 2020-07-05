{include 'header.tpl'}
    <div class="divformLogin">
        
        <form method="POST" action="checkIn" class="formlogin">
            <p class="titulo-registro">Formulario de Registro</p>
            <input type='username' name='username' placeholder = 'Usuario' autocomplete="off">
            <input type='email' name='email' placeholder = 'E-mail'autocomplete="off">
            <input type="password" name='password' placeholder = 'Contraseña' autocomplete="off">
             {if $error}
                <div class="error">
                    {$error}
                </div>
            {/if}
            <button type='submit'>Registrate</button>
        </form>
    </div>
{include 'footer.tpl'}