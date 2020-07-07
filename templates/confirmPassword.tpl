{include 'header.tpl'}
     
    <form method="POST" action="verifyToken" class="formlogin">
        <h3> Recuperar contraseña </h3>
        <p>Ingrese el Token para poder actualizar su contraseña </p>
        <input type='email' name='email' placeholder='Email'>
        <input type='text' name='token' placeholder='Token'>
        <input type='text' name='password' placeholder='Contraseña Nueva'>
        <button type='submit'>Enviar</button>
    </form>

{include 'footer.tpl'}