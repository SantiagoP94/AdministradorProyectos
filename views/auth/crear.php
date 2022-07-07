<div class="contenedor crear">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php';?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Crea tú cuenta en UpTaks</p>

        <?php include_once __DIR__ . '/../templates/alertas.php';?>

        <form class="formulario" method="POST" action="/crear">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input 
                type="text" 
                id="nombre"
                placeholder="Tú nombre"
                name="nombre"
                value="<?php echo $usuario->nombre; ?>"
                >                
            </div>
            <div class="campo">
                <label for="email">Email</label>
                <input 
                type="email" 
                id="email"
                placeholder="Tú email"
                name="email"
                value="<?php echo $usuario->email; ?>"                
                >                
            </div>
            <div class="campo">
                <label for="password">Password</label>
                <input 
                type="password" 
                id="password"
                placeholder="Tú password"
                name="password"
                >                
            </div>
            <div class="campo">
                <label for="password2">Repetir Password</label>
                <input 
                type="password" 
                id="password2"
                placeholder="Repite tú password"
                name="password2"
                >                
            </div>

            <input type="submit" class="boton" value="Crear cuenta">
        </form>
        <div class="acciones">
            <a href="/">Ya tienes cuenta? Inicia sesión</a>
            <a href="/olvide">Olvidaste tú password</a>
        </div>
    </div> <!--.Fin Contenedor-SM-->
</div>