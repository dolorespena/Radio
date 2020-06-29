{include 'header.tpl'}
    <div class="divformLogin">
        <form method="POST" action="checkIn" class="formlogin">
            <input type='username' name='username' placeholder = 'Usuario'>
            <input type='email' name='email' placeholder = 'E-mail'>
            <input type="password" name='password' placeholder = 'Contraseña'>
             {if $error}
                <div class="error">
                    {$error}
                </div>
            {/if}
            <button type='submit'>Registrate</button>
        </form>
    </div>
{include 'footer.tpl'}