<div class="contenedor reestablecer">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php';?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Coloca tú nuevo password</p>

        <?php include_once __DIR__ . '/../templates/alertas.php';?>

        <?php if ($mostrar) {?>

        <form class="formulario" method="POST">
            <div class="campo">
                <label for="password">Password</label>
                <input 
                type="password" 
                id="password"
                placeholder="Tú password"
                name="password"
                >                
            </div>
            <input type="submit" class="boton" value="Guardar password">
        </form>

        <?php }?>
        <div class="acciones">
            <a href="/crear">Aún No tienes cuenta? Obten una</a>
            <a href="/olvide">Olvidaste tú password</a>
        </div>
    </div> <!--.Fin Contenedor-SM-->
</div>