<?php
session_start();if (!$_SESSION["nombreCliente"]) {header("location:ingreso");exit();} ?>
<link rel="stylesheet" type="text/css" href="views/bootstrap/css/gallery.css">
<ol class="breadcrumb">
    <li class="breadcrumb-item active">
        Sección Productos
    </li>
</ol>
<?php if (isset($_GET['action'])): ?>
<form method="post" >
    <div class="container gallery-container">
        <div class="tz-gallery">
            <div class="row">
                <?php $get = ProductosController::getProductosControllers();?>
                <?php foreach ($get as $key): ?>
                    <div class="col-sm-6 col-md-4">

                        <div class="thumbnail">
                            <center><h3><?php  echo $key['nombreProducto'];?></h3></center>
                            <a class="lightbox"><img src="./views/img/<?php  echo $key['urlmimg'];?>"style="display: block; max-width: 100%; height: auto;"></a>
                            <div class="caption">

                                <h6>Precio: <?php  echo $key['precioProducto'];?></h6>

                            </div>
                        </div>
                    </div>
                    <?php
                    if ($nums%3==0){
                        echo '<div class="clearfix"></div>';
                    }
                    $nums++;

                    ///fin
                    ?>

                <?php endforeach?>
            </div>
        </div>
    </div>
</form>
<?php endif?>


