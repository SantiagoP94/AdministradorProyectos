<?php

namespace Model;

class Usuario extends ActiveRecord {
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'email', 'password', 'token', 'confirmado'];

    public function __construct($args=[])
    {   
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';        
        $this->password2 = $args['password2'] ?? '';
        $this->password_actual = $args['password_actual'] ?? '';
        $this->password_nuevo = $args['password_nuevo'] ?? '';
        $this->token = $args['token'] ?? '';
        $this->confirmado = $args['confirmado'] ?? 0;
    }

    //Valdiar el login de usuario
    public function validarLogin(){
        if(!$this->email){
            self::$alertas['error'][]="El email del cliente o usuario es obligatorio";            
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::$alertas['error'][]="El email No es valido";
        }
        if(!$this->password){
            self::$alertas['error'][]="El password no puede ir vacio";            
        }
                
        return self::$alertas;
    }

    //VAlidación para cuentas nuevas
    public function validarNuevaCuenta(){
        if(!$this->nombre){
            self::$alertas['error'][]="El nombre del cliente o usuario es obligatorio";
            
        }
        if(!$this->email){
            self::$alertas['error'][]="El email del cliente o usuario es obligatorio";            
        }
        if(!$this->password){
            self::$alertas['error'][]="El password no puede ir vacio";            
        }
        if(strlen($this->password) < 6 ){
            self::$alertas['error'][]="El password debe contenedor al menos 6 caracteres";            
        }
        if($this->password !== $this->password2){
            self::$alertas['error'][]="Los password deben ser iguales";            
        }
        return self::$alertas;
    }

    public function validarEmail(){
        if(!$this->email){
            self::$alertas['error'][]="El email es obligatorio";
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::$alertas['error'][]="El email No es valido";
        }
        return self::$alertas;
    }

    //Valida el password
    public function validarPassword() : array{
        if(!$this->password){
            self::$alertas['error'][]="El password no puede ir vacio";            
        }
        if(strlen($this->password) < 6 ){
            self::$alertas['error'][]="El password debe contenedor al menos 6 caracteres";
        }
        return self::$alertas;
    }
    public function comprobarPassword() : bool {

        return password_verify($this->password_actual, $this->password);
    }

    //Hashear password
    public function hashPassword() : void{
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    //Generar token
    public function crearToken() : void{
        $this->token = uniqid();
    }

    public function validar_perfil() : array{
        if(!$this->nombre){
            self::$alertas['error'][]='El nombre es obligatorio';
        }
        if(!$this->email){
            self::$alertas['error'][]='El email es obligatorio';
        }
        return self::$alertas;
    }
    public function nuevo_password(){
        if(!$this->password_actual){
            self::$alertas['error'][]='El password actual no puede ir vacio';
        }
        if(!$this->password_nuevo){
            self::$alertas['error'][]='El password nuevo no puede ir vacio';
        }
        if(strlen($this->password_nuevo) < 6){
            self::$alertas['error'][]='El password debe contener mínimo 6 caracteres';
        }
        return self::$alertas;
    }
}