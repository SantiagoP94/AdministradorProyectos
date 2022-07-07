<div class="contenedor olvide">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php';?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Recupera tu acceso a uptask</p>
        <?php include_once __DIR__ . '/../templates/alertas.php';?>
        <form class="formulario" method="POST" action="/olvide">
            <div class="campo">
                <label for="email">Email</label> 
                <input 
                type="email" 
                id="email"
                placeholder="Tú email"
                name="email"
                >                
            </div>
            <input type="submit" class="boton" value="Enviar instrucciones">
        </form>
        <div class="acciones">
            <a href="/">¿Ya tienes una cuenta? Inicia sesión</a>  
            <a href="/crear">¿Aún no tienes una cuenta? Obten una</a>          
            
        </div>
    </div> <!--.Fin Contenedor-SM-->
</div>