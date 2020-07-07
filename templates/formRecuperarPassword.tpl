{include 'header.tpl'}
    <div>   
        <form method="POST" action="checkemail" class="formlogin">
            <h3> Recuperar contraseña </h3>
            <p>Ingrese el Email </p>
            <input type='email' name='email'>
            <button type="submit"> Enviar </button>
            {if $error}
                <div class="error">
                    {$error}
                </div>
            {/if}
        </form>
    </div>
{include 'footer.tpl'}