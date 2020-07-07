{include 'header.tpl'}
    <div class="divformLogin">
        <form method="POST" action="verify" class="formlogin">
            <input type='email' name='email' placeholder = 'E-mail'>
            <input type="password" name='password' placeholder = 'Contraseña'>
        
            {if $error}
                <div class="error">
                    {$error}
                </div>
            {/if}
            <button type='submit'>Ingresar</button>
            <a href='registration' class="link-registro">No eres usuario? Registrate!</a>
            <a href='passwordRecovery' class="link-registro">Olvidé mi contraseña</a>
        </form>
        
    </div>
{include 'footer.tpl'}