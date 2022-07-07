<div class="contenedor login">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php';?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Iniciar sesión</p>

        <?php include_once __DIR__ . '/../templates/alertas.php';?>

        <form class="formulario" method="POST" action="/">
            <div class="campo">
                <label for="email">Email</label>
                <input 
                type="email" 
                id="email"
                placeholder="Tú email"
                name="email"
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

            <input type="submit" class="boton" value="Iniciar Sesión">
        </form>
        <div class="acciones">
            <a href="/crear">Aún No tienes cuenta? Obten una</a>
            <a href="/olvide">Olvidaste tú password</a>
        </div>
    </div> <!--.Fin Contenedor-SM-->
</div>