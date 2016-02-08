<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageRelations($bd);
$idCuadro = Request::get('ID');
$cuadroAutor = $gestor->getCuadroAutor("cu.id_cuadro = "."$idCuadro");
$id2 = Request::get('IDU');
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Piccolo Theme</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- CSS
================================================== -->
<link rel="stylesheet" href="../temas/Piccolo/recursos/css/bootstrap.css">
<link rel="stylesheet" href="../temas/Piccolo/recursos/css/bootstrap-responsive.css">
<link rel="stylesheet" href="../temas/Piccolo/recursos/css/prettyPhoto.css" />
<link rel="stylesheet" href="../temas/Piccolo/recursos/css/custom-styles.css">

<!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <link rel="stylesheet" href="../temas/Piccolo/recursos/style-ie.css"/>
<![endif]--> 

<!-- JS
================================================== -->
<script src="../temas/Piccolo/recursos/js/jquery-1.12.0.min.js"></script>
<script src="../temas/Piccolo/recursos/js/bootstrap.js"></script>
<script src="../temas/Piccolo/recursos/js/jquery.prettyPhoto.js"></script>
<script src="../temas/Piccolo/recursos/js/jquery.custom.js"></script>

</head>

<body>
	<div class="color-bar-1"></div>
    <div class="color-bar-2 color-bg"></div>
    
    <div class="container main-container">
    
      <div class="row header"><!-- Begin Header -->

     
    <!-- Page Content
    ================================================== --> 
    <div class="row">

        <!-- Gallery Items
        ================================================== --> 
        <div class="span12 gallery-single">
 <?php foreach ($cuadroAutor as $indice => $ca){ ?>

            <div class="row">
                <div class="span6">
                    <img src="cuadros/<?= $id2 ?>/<?= $ca["cuadro"]->getImagen() ?>" class="align-left thumbnail" alt="image">
                </div>
                <div class="span6">
                    <h2><?= $ca["cuadro"]->getNombre() ?></h2>
                    <p><?= $ca["cuadro"]->getDescripcion() ?></p>

                    <ul class="project-info">
                        <li><h6>Date:</h6> <?= $ca["cuadro"]->getFecha() ?></li>
                        <li><h6>Alias:</h6><?= $ca["autor"]->getAlias() ?></li>
                        <li><h6>Name:</h6><?= $ca["autor"]->getNombre()." ". $ca["autor"]->getApellidos() ?> </li>
                        <li><h6>Country:</h6> <?= $ca["autor"]->getPais() ?></li>
                        <li><h6>City:</h6> <?= $ca["autor"]->getCiudad() ?></li>
                    </ul>
                    <a href="javascript:history.back(1)" class="pull-right"><i class="icon-arrow-left"></i>Back to Gallery</a>
                </div>
            </div>
     <?php } ?>
        </div><!-- End gallery-single-->

    </div><!-- End container row -->
    
    </div> <!-- End Container -->
</body>
</html>
