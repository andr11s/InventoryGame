<?php session_start();if (!$_SESSION["nombreCliente"]) {header("location:ingreso");exit();}?>

<?php if ($_GET['action'] == 'ReportCliente'): ?>
<!-- <h3 class="alert alert-info">Ventas Diarias</h3> -->
<div class="row">
    <div class="col-md-6 mx-md-auto">
        <span class="text-danger">Elegir una Fecha:</span>
        <form method="post">
            <input type="hidden" name="idCliente"  value="<?php echo $_SESSION["idCliente"]; ?>">
            <input type="text" name="fecha" class="form-control" id="datepicker">
            <div class="clearfix"><br> </div>

            <center><input type="submit" name="ventaDiarias" class="btn btn-outline-primary" value="Consultar"></center>
            <div class="clearfix"><br> </div>
        </form>
    </div>
    <div class="col-md-9 top">
        <h4 class="alert alert-warning">Ventas Diarias</h4>



        <?php $ventaDiarias = VentasController::ventasUsuarioController()?>

        <table class="table table-striped table-sm" id='tablas'>
            <thead class="bg-primary text-white">
            <tr>
                <td>Nombre y Apellido</td>
                <td>Nombre del Producto</td>
                <td>Nro y tipo de Factura</td>
                <td>Monto total</td>
            </tr>
            </thead>


            <?php if (isset($_POST['ventaDiarias'])): ?>

                <?php foreach ($ventaDiarias as $key): ?>
                    <?php $total = $total + $key['totalVenta']?>
                    <tr>
                        <td align="center"> <?php echo $key['nombreCliente'] . ' ' . $key['apellidoCliente'] ?></td>
                        <td align="center"><?php echo $key['nombreProducto'] ?></td>
                        <td align="center"><?php echo 'Nro: ' . $key['numFac'] . ' ' . 'Tipo:' . $key['tipoFactura'] ?></td>
                        <td align="center"><?php echo '$' . $key['totalVenta'] ?></td>
                    </tr>
                <?php endforeach?>
            <?php endif?>
        </table>
    </div>
    <div class="col-md-3">
        <div class="alert alert-info" role="alert">
            <h5>  <strong> Ventas Total del dia <?php echo date("d-m-Y", strtotime($key['fechaVenta'])); ?>: <span class="text-gray-dark"> <i class="fa fa-usd"></i> <?php echo $total; ?></span></strong></h5>
        </div>
    </div>
    <?php endif?>
</div>



<script>
    $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '< Ant',
        nextText: 'Sig >',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        weekHeader: 'Sm',
        dateFormat: 'yy/m/d',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['es']);
    $( function() {
        $( "#datepicker" ).datepicker();
    } );
</script>


