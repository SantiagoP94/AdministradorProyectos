<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {
    protected $email;
    protected $nombre;
    protected $token;

    public function __construct($email,$nombre,$token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion(){
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '793cbe0f940f8d';
        $mail->Password = '86518a1fed4ff4';

        $mail->setFrom('cuentas@uptask.com');
        $mail->addAddress($this->email, 'uptask.com');
        $mail->Subject = 'Confirma tu cuenta';

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .="<p><strong>Hola ". $this->nombre."</strong> 
        Has creado tu cuenta en uptaks, 
        debes confirmarla en el siguiente enlace</p>";
        $contenido .="<p>Presiona aquí: <a href='http://localhost:3000/confirmar?token=" .
        $this->token . "'>Confirmar cuenta</a></p>";
        $contenido .="<p>Si tu no creaste esta cuenta, puedes ignorar este mensaje</p>";
        $contenido .='</html>';

        $mail->Body = $contenido;

        //Enviar el email
        $mail->send();
    }
    public function enviarInstrucciones(){
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '793cbe0f940f8d';
        $mail->Password = '86518a1fed4ff4';

        $mail->setFrom($this->email);
        $mail->addAddress($this->email, 'uptask.com');
        $mail->Subject = 'Reestablece tú password';

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .="<p><strong>Hola ". $this->nombre."</strong> 
        PArece que has olvidado tú password. sigue el siguiente enlace
        Para recuperarlo</p>";
        $contenido .="<p>Presiona aquí: <a href='http://localhost:3000/reestablecer?token=" .
        $this->token . "'>Reestablecer password</a></p>";
        $contenido .="<p>Si tu no creaste esta cuenta, puedes ignorar este mensaje</p>";
        $contenido .='</html>';

        $mail->Body = $contenido;

        //Enviar el email
        $mail->send();
    }
}