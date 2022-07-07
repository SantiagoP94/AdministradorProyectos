<?php
namespace Controllers;

use Model\Proyecto;
use Model\Usuario;
use MVC\Router;


class DashboardController{
    public static function index(Router $router ){
        session_start();

        isAuth();

        $id = $_SESSION['id'];

        $proyectos = Proyecto::belongsTo('propietarioId', $id);
        
        $router->render('dashboard/index', [
            'titulo' => 'Proyectos',
            'proyectos' => $proyectos
        ]); 
    }
    public static function crear_proyecto(Router $router ){
        session_start();
        
        isAuth();
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $proyecto = new Proyecto($_POST);
            //Validación
            $alertas = $proyecto->validarProyecto();

            if(empty($alertas)){                
                //Generar url unica
                $hash = md5(uniqid());
                $proyecto->url = $hash;
                
                //Almacenar el creador del proyecto
                $proyecto->propietarioId = $_SESSION['id'];
                // debuguear($proyecto);
                
                //Guardar proyecto
                $proyecto->guardar();
                
                //Redireccionar
                header('Location: /proyecto?id=' . $proyecto->url);
            }
        }
        
        $router->render('dashboard/crear-proyecto', [
            'titulo' => 'Crear Proyecto',
            'alertas' => $alertas
        ]); 
    }
    public static function proyecto(Router $router ){
        session_start();
        
        isAuth();
        $alertas = [];        
        $token = $_GET['id'];
        if(!$token) header('Location: /dashboard');
        
        //REvisar que la persona que visita el proyecto es quien lo creo
        $proyecto = Proyecto::where('url', $token);
        if($proyecto->propietarioId !== $_SESSION['id']){
            header('Location: /dashboard');
        }
        
        $router->render('dashboard/proyecto', [
            'titulo' => $proyecto->proyecto,
            'alertas' => $alertas
        ]); 
    }    
    public static function perfil(Router $router ){
        session_start();
        isAuth();
        $alertas = [];

        $usuario = Usuario::find($_SESSION['id']);        
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validar_perfil();

            if(empty($alertas)){

                //Verificar email que no exista
                $existeUsuario = Usuario::where('email', $usuario->email);
                
                if($existeUsuario && $existeUsuario->id !== $usuario->id){
                    //
                    Usuario::setAlerta('error', 'Email ya registrado');
                    $alertas = $usuario->getAlertas();
                } else {
                    //Guardar registro
                    //Guardar usuario
                    $usuario->guardar();

                    Usuario::setAlerta('exito', 'Guardado correctamente');
                    $alertas = $usuario->getAlertas();
                    
                    //Asignar nombre nuevo a la barra
                    $_SESSION['nombre'] = $usuario->nombre;
                }                
            }
        }

        $router->render('dashboard/perfil', [
            'titulo' => 'Perfil',
            'usuario' => $usuario,
            'alertas' => $alertas
        ]); 
    }
    public static function cambiar_password(Router $router ){
        session_start();
        isAuth();
        $alertas = [];

        $usuario = Usuario::find($_SESSION['id']);        
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario = Usuario::find($_SESSION['id']);;
            $usuario->sincronizar($_POST);
            $alertas = $usuario->nuevo_password();

            if(empty($alertas)){

                $resultado = $usuario->comprobarPassword();
                
                if($resultado){                    
                    //Asignar nuevo password
                    $usuario->password = $usuario->password_nuevo;

                    //eliminar propiedades no necesarias
                    unset($usuario->password_actual);
                    unset($usuario->password_nuevo);

                    //Hash nuevo pass
                    $usuario->hashPassword();

                    //Actualizar
                    $resultado = $usuario->guardar();

                    if($resultado){
                        Usuario::setAlerta('exito', 'Password guardado correctamente');
                    $alertas = $usuario->getAlertas();
                    }

                } else {
                    //Guardar registro
                    Usuario::setAlerta('error', 'Password incorrecto');
                    $alertas = $usuario->getAlertas();
                }                
            }
        }

        $router->render('dashboard/cambiar-password', [
            'titulo' => 'Cambiar Password',
            'usuario' => $usuario,
            'alertas' => $alertas
        ]); 
    }
}