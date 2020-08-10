//Validacioens produto
$("#precioProducto").change(() => {
    var PrecioProducto = $('#precioProducto').val();
    // console.log(producto);

    if (PrecioProducto.length < 0) {
        $("#Alertprecio").html('<p  class="alert alert-danger">El precio no puede ser negativo!</p>');
        $('#Alertprecio').addClass('a');
        $("#formprecio").addClass('has-danger');
        $("#precioProducto").addClass('form-control form-control-danger');
        $("#button").attr('disabled', 'disabled');
    }

    if (PrecioProducto < 0) {
        $("#Alertprecio").html('<p  class="alert alert-danger">El precio no puede ser negativo!</p>');
        $('#Alertprecio').addClass('a');
        $("#formprecio").addClass('has-danger');
        $("#precioProducto").addClass('form-control form-control-danger');
        $("#button").attr('disabled', 'disabled');
    }
    if (PrecioProducto > 1) {
        $("#form").removeClass('has-danger');
        $("#formprecio").removeClass('has-success');
        $("#precioProducto").removeClass('form-control form-control-danger');
        $("#precioProducto").addClass('form-control form-control-success');
        $('#precioProducto').css('border', 'solid 1px #8FF48A');
        $("#Alertprecio").html('');
        $("#button").removeAttr('disabled', 'disabled');

    }
});


//Validacioens proveedor

$("#nombreProveedor").change(function () {
    var NombreProveedor = $('#nombreProveedor').val();
    // console.log(producto);
    if (NombreProveedor.length > 4) {
        var datos = new FormData();
        datos.append('inputvalidarProveedor', NombreProveedor);
        $.ajax({
            url: 'views/ajax.php',
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            success: function (respuesta) {
                if (respuesta == 1) {
                    $("#AlertaNombre").html('<p  class="alert alert-danger">El Proveedr ya existe</p>');
                    $('#AlertaNombre').addClass('a');
                    $("#form").addClass('has-danger');
                    $("#nombreProveedor").addClass('form-control form-control-danger');
                    $("#button").attr('disabled', 'disabled');
                    usuarioExistente = true;
                } else {
                    $("#form").removeClass('has-danger');
                    $("#form").addClass('has-success');
                    $("#nombreProveedor").removeClass('form-control form-control-danger');
                    $("#nombreProveedor").addClass('form-control form-control-success');
                    $('#nombreProveedor').css('border', 'solid 1px #8FF48A');
                    $("#pro").html('');
                    $("#button").removeAttr('disabled', 'disabled');
                    usuarioExistente = false;
                }
            }
        })
    }
});


$("#apellidoProveedor").change(function () {
    let ApellidoProveedor = $('#apellidoProveedor').val();

    if (ApellidoProveedor.length > 4) {
        $("#formapellido").removeClass('has-danger');
        $("#apellidoProveedor").removeClass('form-control form-control-danger');
        $("#apellidoProveedor").addClass('form-control form-control-success');
        $('#apellidoProveedor').css('border', 'solid 1px #8FF48A');
        $("#alertApellido").html('');
        $("#button").removeAttr('disabled', 'disabled');

    }
    if (ApellidoProveedor < 0) {

        $("#alertApellido").html('<p  class="alert alert-danger">EL apellido no puede ser negativo</p>');
        $('#AlertaNombre').addClass('a');
        $("#formapellido").addClass('has-danger');
        $("#apellidoProveedor").addClass('form-control form-control-danger');
        $("#button").attr('disabled', 'disabled');
    }

    if (ApellidoProveedor.length < 4) {
        $("#alertApellido").html('<p  class="alert alert-danger">Tienes que tener maximo 4 letras o numeros</p>');
        $('#AlertaNombre').addClass('a');
        $("#formapellido").addClass('has-danger');
        $("#apellidoProveedor").addClass('form-control form-control-danger');
        $("#button").attr('disabled', 'disabled');
    }
});

$("#direccionProveedor").change(function () {
    let Direccion = $('#direccionProveedor').val();

    if (Direccion.length > 4) {
        $("#formDireccion").removeClass('has-danger');
        $("#direccionProveedor").removeClass('form-control form-control-danger');
        $("#direccionProveedor").addClass('form-control form-control-success');
        $('#direccionProveedor').css('border', 'solid 1px #8FF48A');
        $("#AlertDirecccion").html('');
        $("#button").removeAttr('disabled', 'disabled');

    }
    if (Direccion < 0) {

        $("#AlertDirecccion").html('<p  class="alert alert-danger">EL apellido no puede ser negativo</p>');
        $('#AlertDirecccion').addClass('a');
        $("#formDireccion").addClass('has-danger');
        $("#direccionProveedor").addClass('form-control form-control-danger');
        $("#button").attr('disabled', 'disabled');
    }

    if (Direccion.length < 5) {
        $("#AlertDirecccion").html('<p  class="alert alert-danger">Tienes que tener maximo 5 letras o numeros</p>');
        $('#AlertDirecccion').addClass('a');
        $("#formDireccion").addClass('has-danger');
        $("#direccionProveedor").addClass('form-control form-control-danger');
        $("#button").attr('disabled', 'disabled');
    }
});