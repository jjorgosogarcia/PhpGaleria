<?php
session_start();
require '../clases/AutoCarga.php';
require_once '../clases/googleMail/Google/autoload.php';
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
