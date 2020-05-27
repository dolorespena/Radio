{include 'header.tpl'}
    <div class="divformLogin">
        <form method="POST" action="verify" class="formlogin">
            <input type='email' name='username' placeholder = 'E-mail'>
            <input type="password" name='password' placeholder = 'Contraseña'>
        
            {if $error}
            <div class="error">
                {$error}
            </div>
            {/if}
            
            <button type='submit'>Ingresar</button>
        </form>
    </div>
{include 'footer.tpl'}