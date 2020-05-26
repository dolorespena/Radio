{include 'header.tpl'}

    <form method="POST" action="verify" >
        <input type='email' name='username' placeholder = 'E-mail'>
        <input type="password" name='password' placeholder = 'Contraseña'>
       
        {if $error}
        <div class="error">
            {$error}
        </div>
        {/if}
        
        <button type='submit'>Ingresar</button>
    </form>

{include 'footer.tpl'}