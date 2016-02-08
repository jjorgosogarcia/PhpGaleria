<?php

class sendGoogleMail {

    static function solicitarToken() {
        session_start();
        require_once 'googleMail/Google/autoload.php';
        $cliente = new Google_Client();
        $cliente->setApplicationName(Constant::APPLICATIONAME);
        $cliente->setClientId(Constant::CLIENTID);
        $cliente->setClientSecret(Constant::SECRETCLIENTID);
        $cliente->setRedirectUri(Constant::URI);

        $cliente->setScopes('https://www.googleapis.com/auth/gmail.compose');
        $cliente->setAccessType('offline');
        if (!$cliente->getAccessToken()) {
            $auth = $cliente->createAuthUrl(); //solicitud
            header("Location: $auth");
        }
    }

    static function saveToken() {
        session_start();
        require_once 'googleMail/Google/autoload.php';
        $cliente = new Google_Client();
        $cliente->setApplicationName(Constant::APPLICATIONAME);
        $cliente->setClientId(Constant::CLIENTID);
        $cliente->setClientSecret(Constant::SECRETCLIENTID);
        $cliente->setRedirectUri(Constant::URI);
        $cliente->setScopes('https://www.googleapis.com/auth/gmail.compose');
        $cliente->setAccessType('offline');
        if (isset($_GET['code'])) {
            $cliente->authenticate($_GET['code']);
            $_SESSION['token'] = $cliente->getAccessToken();
            $archivo = "../clases/googleMail/token.conf";
            $fh = fopen($archivo, 'w') or die("error");
            fwrite($fh, $cliente->getAccessToken()); //almacenamiento del token
            fclose($fh);
        }
    }

    static function sendActivationMail2($destinatario, $asuntoMensaje, $contenidoMensaje) {
        session_start();
        $activacion = sha1($destinatario . Constant::SEMILLA);
        $origen = "jjorgosogarcia@gmail.com";
        $alias = "Prueba de correo";
        $destino = $destinatario;
        $asunto = $asuntoMensaje;
        $mensaje = $contenidoMensaje;
        require_once 'googleMail/Google/autoload.php';
        require_once 'googleMail/class.phpmailer.php';  //las últimas versiones también vienen con autoload
        $cliente = new Google_Client();    
        $cliente->setApplicationName(Constant::APPLICATIONAME);
        $cliente->setClientId(Constant::CLIENTID);
        $cliente->setClientSecret(Constant::SECRETCLIENTID);
        $cliente->setRedirectUri(Constant::URI2);        
        $cliente->setScopes('https://www.googleapis.com/auth/gmail.compose');
        $cliente->setAccessToken(file_get_contents('../oauth/token.conf'));
        if ($cliente->getAccessToken()) {
            $service = new Google_Service_Gmail($cliente);
            try {
                $mail = new PHPMailer();
                $mail->CharSet = "UTF-8";
                $mail->From = $origen;
                $mail->FromName = $alias;
                $mail->AddAddress($destino);
                $mail->AddReplyTo($origen, $alias);
                $mail->Subject = $asunto;
                $mail->Body = $mensaje;
                $mail->preSend();
                $mime = $mail->getSentMIMEMessage();
                $mime = rtrim(strtr(base64_encode($mime), '+/', '-_'), '=');
                $mensaje = new Google_Service_Gmail_Message();
                $mensaje->setRaw($mime);
                $service->users_messages->send('me', $mensaje);
                echo "correo enviado correctamente";
            } catch (Exception $e) {
                print("Error en el envio del correo " . $e->getMessage);
            }
        } else {
            echo "no conectado con gmail";
        }
    }

}
