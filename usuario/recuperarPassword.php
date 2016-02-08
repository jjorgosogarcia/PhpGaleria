

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="../css/estilos.css" rel="stylesheet">
    </head>
    <body>
        <form action="../controlUsuario/phprecoverPassword.php" method="POST" enctype="multipart/form-data">
            <div class="logo"></div>
            <div class="login-block">
            <h1>Recuperar Clave</h1>
            <label for="email">Email: </label><input type="email" name="email" value="" /><br/>
            <input type="submit" value="Enviar"/>
            <a href="../login/login.php"><button type="button">Atras</button></a>
            </div>
        </form>
    </body>
</html>
