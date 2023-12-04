
(function ($) {
    "use strict";


    /*==================================================================
    [ Focus input ]*/
    $('.input100').each(function(){
        $(this).on('blur', function(){
            if($(this).val().trim() != "") {
                $(this).addClass('has-val');
            }
            else {
                $(this).removeClass('has-val');
            }
        })    
    })
  
  
    /*==================================================================
    [ Validate ]*/
    var input = $('.validate-input .input100');

    $('.validate-form').on('submit',function(){
        var check = true;

        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }

        return check;
    });


    $('.validate-form .input100').each(function(){
        $(this).focus(function(){
           hideValidate(this);
        });
    });

    function validate (input) {
        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        }
        else {
            if($(input).val().trim() == ''){
                return false;
            }
        }
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }
    
    /*==================================================================
    [ Show pass ]*/
    var showPass = 0;
    $('.btn-show-pass').on('click', function(){
        if(showPass == 0) {
            $(this).next('input').attr('type','text');
            $(this).find('i').removeClass('zmdi-eye');
            $(this).find('i').addClass('zmdi-eye-off');
            showPass = 1;
        }
        else {
            $(this).next('input').attr('type','password');
            $(this).find('i').addClass('zmdi-eye');
            $(this).find('i').removeClass('zmdi-eye-off');
            showPass = 0;
        }
        
    });

    $('#ingresoProduct').on('click', function(){
        $('#tablaVentas').hide('fast');
        $('#tablaProductos').hide('fast');
        $('#FormularioProduct').show('slow');
    });

    $('#verProducto').on('click', function(){
        $('#tablaVentas').hide('fast');
        $('#FormularioProduct').hide('fast');
        $('#tablaProductos').show('slow');
    });

     $('#verVentas').on('click', function(){
        $('#FormularioProduct').hide('fast');
        $('#tablaProductos').hide('fast');
         $('#tablaVentas').show('slow');
    });

     $(".buttons").on("click", function(){
        $(".precio").val("");
     })

     $('.editar').on('click', function() {
        var dataString = $(this).children().val();
        $('.modals').show('slow');
        var datos = {"codigo":dataString};
        

        $.ajax({
            type: "POST",
            url: "views/ajax/ficcion.php",
            data: datos,
        })
        .then(function(data){

            var datos = Object.values(data);
            var datas = Object.values(datos[0])
            const caratula  =  datos[0].caratula;
            const trailer  =  datos[0].trailer;
            const pelicula  =  datos[0].pelicula;
            const fecha  =  datos[0].fecha;
            const size = datos[0].peso;
           
            const CodigoCriminal = datos[0].codigo;

            
                $(".editCodigo").val(datos[0].codigo)

                $(".codigoCriminal").val(datos[0].codigo)
                $(".fechaCriminal").val(datos[0].fecha)
                $(".caratulaCriminal").val(datos[0].caratula)
                $(".trailerCriminal").val(datos[0].trailer)
                $(".peliculaCriminal").val(datos[0].pelicula)
                
                    var pesish = size.toLocaleString(size.substr(0,4))
                    console.log(pesish)
                $(".cara").text("Imagen de caratula: "+caratula)
                $(".tra").text("Trailer: "+trailer)
                $(".pel").text("Pelicula: "+pelicula)
                $(".fech").text("Fecha: "+fecha)
                $(".peso").text("Peso: "+pesish)
                $('.pesoPeliculaa').val(size.substr(0,4))

                $(".editNombre").val(datos[0].nombrePelicula)
                $(".editCantidad").val(datos[0].cantidad)
                $(".editDiscos").val(datos[0].discos)
                $(".editCinavia").prepend(`<option selected value="${datos[0].cinavia}">${datos[0].cinavia} (Seleccionado)</option>`)
                $(".editClasi").prepend(`<option selected value="${datos[0].clasificacion}">${datos[0].clasificacion} (Seleccionado)</option>`)
                $(".editLenguaje").val(datos[0].lenguaje)
                $(".editSelectGeneros").prepend(`<option selected value="${datos[0].genero}">${datos[0].genero} (Seleccionado)</option>`)
                $(".editSelectTipos").prepend(`<option selected value="${datos[0].tipo}">${datos[0].tipo} (Seleccionado)</option>`)

    
                   

            })

        })
     





     $('.cerrarEditado').on('click', () =>{
        location.reload();
     })
     
     $(".EditadoPelicula").on('click', function(event){
        if ( $(".editDiscos").val() < 1 ) {
            $(".editDiscos").val(1)
        }
        
        

        var cantidad = document.getElementById("archivosPelis").files.length; 
        if (cantidad == 0) {
            $(".editPeli").submit()
        }else{
            for (var i = 0; i < cantidad; i++) {
            var peso = document.getElementById("archivosPelis").files[i].size;
            var dat = document.getElementById("archivosPelis").files[i].name;
            if (i == 0) {
                var datt = dat;
                var pesoo = peso;
            }else{
                var datt = datt+","+dat;
                var pesoo = pesoo+","+peso;
            }
            
            }
            
            
            var datos = {"revisarArchivo":datt};
            $.ajax({
                type: "POST",
                url: "views/ajax/ficcion.php",
                data: datos,
            })
            .then(function(data){
               
                if (data=="si") {
                    
                    $('.nombreYaRevisado').val(datt)
                    $('.cantidadRevision').val(cantidad)
                    $('.pesoYaRevisado').val(pesoo)
                    $('#archivosPelis').val('')
                    $(".editPeli").submit()
                    
                    
                }
                else{      
                    console.log(data) 
                    $('.cantidadRevision').val(cantidad) 
                    $(".editPeli").submit()
                }
            })
        }
        
     })

     $(".agregalaPeli").on('click', function(event){
        if (document.getElementById("peliAgrega").files[0].name) {
                event.preventDefault()}  
        var dat = document.getElementById("peliAgrega").files[0].name;
        var peso = document.getElementById("peliAgrega").files[0].size;
        var cantidad = document.getElementById("peliAgrega").files.length;
        console.log(dat);
        var datos = {"revisarArchivo":dat};
        $.ajax({
            type: "POST",
            url: "views/ajax/ficcion.php",
            data: datos,
        })
        .then(function(data){
            if (data=="si") {
                $('.nombreYaRevisado').val(dat)
                $('.pesoYaRevisado').val(peso)
                $('.cantidadRevision').val(cantidad)
                $('#peliAgrega').val('')
                $(".editPeli").submit()
                
                
            }
            else{
                 $('.cantidadRevision').val(cantidad)   
                $(".editPeli").submit()
            }
        })
     })

     $(".editGene").on('click', function(){
        $('.modals').show('slow')
        var dataString = $(this).children().next().val();
        var fondo = $(this).children().next().next().val();
        var icono = $(this).children().next().next().next().val();
        $(".editNameGene").val(dataString)
        $(".inputNombre").val(dataString)
        $(".inputFondo").val(fondo)
        $(".inputIcono").val(icono)
        
     })
     $(".editInv").on('click', function(){
        $('.modals').show('slow')
        var dataString = $(this).children().next().val();
        var fondo = $(this).children().next().next().val();
        var icono = $(this).children().next().next().next().val();
        var precioInv = $(this).children().next().next().next().val();
        $(".editNameGene").val(dataString)
        $(".inputNombre").val(dataString)
        $(".inputCantidad").val(fondo)
        $(".inputPrec").val(precioInv)
        $(".inputIcono").val(icono)
        
     })

     $(".newGene").on('click', function(){
        $('.modalsNew').show('slow')
     })

     $(".editarTipos").on('click', function(){
        $('.modals').show('slow')
        var dataString1 = $(this).children().val();
        var dataString = $(this).children().next().val();
        var dataString2 = $(this).children().next().next().val(); 
        $(".editNameTipo").val(dataString1)
        $(".editNameServicio").val(dataString)
        $(".editComision").val(dataString2)
        $(".editNameTipoAnterior").val(dataString1)
        
     })

    

    $(".inputCodig").keypress(function(e) {
    var keycode = (e.keyCode ? e.keyCode : e.which);
    if (keycode == '13') {
        var code = $(".inputCodig").val()
        var peliculasVentas = $(".peliculasVentas")
        var inspector = false
        var inputVent = $(".inputVent").val()
        for (var i = 0; i < peliculasVentas.length; i++) {
           if ($(".peliculasVentas").eq(i).hasClass(code)) {
            inspector = true;
            var nombre = $("."+code+"").children().next().children().val()
            var precio = $("."+code+"").children().next().next().next().children().val()
            var disco = $("."+code+"").children().next().next().next().next().children().val()
            var tipo = $("."+code+"").children().next().next().next().next().next().children().val()
            if (disco < 1) {
                var precioPrimero = parseFloat(precio)
            }
            else{
               var precioPrimero = parseFloat(precio) * parseFloat(disco) 
            }
            
            var comprado = `<tr class="ventaTabs" style="text-align: center;">
                            <th><input hidden type="text" value="${code}">${code}</th>
                            <th><input hidden type="text" value="${nombre}">${nombre}</th>
                            <th><input hidden type="text" value="${precioPrimero}">${precioPrimero}</th>
                            <th style="display:none;"><input class="tipoVent" hidden type="text" value="${tipo}">${tipo}</th>
                            <th class="eliminarVent" onclick="dele(${precio})" style="cursor:pointer"><i class="fas fa-trash"></i></th>
                          </tr>`
            $(".tbody").append(comprado)
            if (disco < 1) {
                var total = (parseFloat(precio) + parseFloat(inputVent))
            }
            else{
               var total = (parseFloat(precio) + parseFloat(inputVent)) * parseFloat(disco); 
            }
            
            $(".inputVent").val(total)

            $(".eliminarVent").on("click", function(){
    $(this).parent().remove()

})
           }


        }

        if (inspector==false) {
            swal({
                title: "¡Error!",
                text: "El codigo no existe",
                icon: "error",
            })

        }
        $(".inputCodig").val("")
    }
    });



     $(".cleanVenta").on("click" ,function(){

        if ($(".inputServicio").val() == "" || $(".inputVent").val() == "") {
            swal({
                    title: "¡Error!",
                    text: "¡No has seleccionado a una empleada o servicio!",
                    icon: "error",
                })
        }
        else{


        var precio = $(".inputVent").val()
        var servicio = $('.ServicioEscondido').val()
        var comision = $('.ComisionEscondida').val()
        var ganancia = 100 - parseFloat(comision)
        var gananciaReal = parseFloat(precio) * parseFloat("0."+ganancia)
        var comisionReal = parseFloat(precio) * parseFloat("0."+comision)
        var trabajador = $(".inputServicio").val()
       
       

       var datos = {"trabajador":trabajador,
                    "total":precio,
                    "servicio":servicio,
                    "ganancia":gananciaReal,
                    "comision":comisionReal}
         $.ajax({
            type: "POST",
            url: "views/ajax/ficcion.php",
            data: datos,
        })

         .then(function(data){
            console.log(data)
            var tabla = `<tr>
                        <td style="text-align: center;">${trabajador}</td>
                        <td style="text-align: center;">${servicio}</td>
                        <td style="text-align: center;">${gananciaReal}</td>
                        <td style="text-align: center;">${comisionReal}</td>
                        <td style="text-align: center;">${precio}</td>
                        
                      </tr>`

                      $(".bodyTotal").prepend(tabla)
                      $(".inputTotal").val(parseFloat($(".inputTotal").val()) + parseFloat(precio))

                     location.reload()
             })
             
        }
     });

     $(".delete").on("click" , function(event){
         var codigo = $(this).children().val();
        

         var datos = {"codigoDelete":codigo};

        swal({
              title: "¿Seguro?",
              text: "La pelicula se eliminara del sistema",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                $.ajax({
            type: "POST",
            url: "views/ajax/ficcion.php",
            data: datos,
        })
        .then(function(data){
            if (data == "ok") {
                swal({
                    title: "¡OK!",
                    text: "¡La pelicula ha sido borrada correctamente!",
                    icon: "success",
                })
                .then((result) => {
                    if (result) {
                        window.location = "editarPeliculas"
                    }else{
                        window.location = "editarPeliculas"
                    }
                })
            }else{
                swal({
                    title: "Error!",
                    text: "Hemos tenido errores tecnicos",
                    icon: "error",
                })
                .then((result) => {
                    if (result) {
                        window.location = "editarPeliculas"
                    }else{
                        window.location = "editarPeliculas"
                    }
                })
            }
             
        })
              } else {
                swal("No se ha borrado nada");
              }
            });

       
        

        

     })

     
   

     $('.EditadoTipo').on('click', function(event){
        event.preventDefault();
        var cedula = $('.editNameTipo').val()
        var nombre = $('.editNameServicio').val()
        var cedulaAnterior = $('.editNameTipoAnterior').val()
        var porcentaje = $('.editComision').val()
        const datos = {"cedulaEditado":cedula,"nombreEditado":nombre,"cedulaAnterior":cedulaAnterior,"porcentaje":porcentaje}

         $.ajax({
            type: "POST",
            url: "views/ajax/ficcion.php",
            data: datos,
        })
        .then(function(data){
            if (data == "ok") {
                swal({
                    title: "¡OK!",
                    text: "¡El empleado ha sido editado correctamente!",
                    icon: "success",
                })
                .then((result) => {
                    if (result) {
                        window.location = "empleadas"
                    }else{
                        window.location = "empleadas"
                    }
                })
            }else{
                swal({
                    title: "Error!",
                    text: "Ya existe esta cedula",
                    icon: "error",
                })
                .then((result) => {
                    if (result) {
                        window.location = "empleadas"
                    }else{
                        window.location = "empleadas"
                    }
                })
            }
             
        })

     })
      $('.CrearTipo').on('click', function(event){
        event.preventDefault();
        var cedula = $('.createCedula').val()
        var nombre = $('.createName').val()
        var comision = $('.createComision').val()
        const datos = {"cedulaCreate":cedula,"nombre":nombre,"comision":comision}

         $.ajax({
            type: "POST",
            url: "views/ajax/ficcion.php",
            data: datos,
        })
        .then(function(data){
            if (data == "ok") {
                swal({
                    title: "¡OK!",
                    text: "¡El empleado ha sido creado correctamente!",
                    icon: "success",
                })
                .then((result) => {
                    if (result) {
                        window.location = "empleadas"
                    }else{
                        window.location = "empleadas"
                    }
                })
            }else{
                swal({
                    title: "Error!",
                    text: "Ya existe un tipo con ese nombre",
                    icon: "error",
                })
                .then((result) => {
                    if (result) {
                        window.location = "empleadas"
                    }else{
                        window.location = "empleadas"
                    }
                })
            }
             
        })

     })

    $(".EliminarTipos").on("click" , function(event){

        var tipo = $(this).children().val();
        

        var datos = {"eliminarTipo":tipo};
        
        swal({
              title: "¿Seguro?",
              text: "El tipo sera eliminado",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                $.ajax({
            type: "POST",
            url: "views/ajax/ficcion.php",
            data: datos,
        })
        .then(function(data){
            if (data == "ok") {
                swal({
                    title: "¡OK!",
                    text: "¡La pelicula ha sido borrada correctamente!",
                    icon: "success",
                })
                .then((result) => {
                    if (result) {
                        window.location = "empleadas"
                    }else{
                        window.location = "empleadas"
                    }
                })
            }else{
                swal({
                    title: "Error!",
                    text: "Hemos tenido errores tecnicos",
                    icon: "error",
                })
                .then((result) => {
                    if (result) {
                        window.location = "empleadas"
                    }else{
                        window.location = "empleadas"
                    }
                })
            }
             
        })
              } else {
                swal("El tipo no se elimino");
              }
            });
        

     })
    $('.EliminarGene').on('click', function(){
        var nombre = $(this).children().next().val()

        const datos = {"GeneroEliminar":nombre}
        swal({
              title: "¿Seguro?",
              text: "El servicio sera eliminado",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                $.ajax({
            type: "POST",
            url: "views/ajax/ficcion.php",
            data: datos,
        })

        .then(function(data){
            if (data == "ok") {
                swal({
                    title: "¡OK!",
                    text: "¡El ha sido borrada correctamente!",
                    icon: "success",
                })
                .then((result) => {
                    if (result) {
                        window.location = "servicios"
                    }else{
                        window.location = "servicios"
                    }
                })
            }else{
                swal({
                    title: "Error!",
                    text: "Hemos tenido errores tecnicos",
                    icon: "error",
                })
                .then((result) => {
                    if (result) {
                        window.location = "servicios"
                    }else{
                        window.location = "servicios"
                    }
                })
            }
             
        })
              } else {
                swal("El genero no se elimino");
              }
            });

        
    })
    $('.EliminarProducto').on('click', function(){
        var nombre = $(this).children().next().val()

        const datos = {"productoEliminar":nombre}
        swal({
              title: "¿Seguro?",
              text: "El producto sera eliminado",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                $.ajax({
            type: "POST",
            url: "views/ajax/ficcion.php",
            data: datos,
        })

        .then(function(data){
            if (data == "ok") {
                swal({
                    title: "¡OK!",
                    text: "¡El ha sido borrada correctamente!",
                    icon: "success",
                })
                .then((result) => {
                    if (result) {
                        window.location = "inventario"
                    }else{
                        window.location = "inventario"
                    }
                })
            }else{
                swal({
                    title: "Error!",
                    text: "Hemos tenido errores tecnicos",
                    icon: "error",
                })
                .then((result) => {
                    if (result) {
                        window.location = "inventario"
                    }else{
                        window.location = "inventario"
                    }
                })
            }
             
        })
              } else {
                swal("El genero no se elimino");
              }
            });

        
    })
    $(".inputCambio").keypress(function(e) {

        var keycode = (e.keyCode ? e.keyCode : e.which);
        if (keycode == '13') {

            var code = $(this).val()
            console.log(code)
            const datos = {"cambioCodigo":code}
            $.ajax({
                type: "POST",
                url: "views/ajax/ficcion.php",
                data: datos,
            })
            .then(function(data){
                if (data === "ok") {
                    $(".thisHidden").hide()
                    $(".cambioOculto").show()
                    $('.inputCambioDos').focus();
                }
            })
            .fail(function(data) {
                console.log(data)
            })
        }
    })
     $(".inputCambioDos").keypress(function(e) {      
        var keycode = (e.keyCode ? e.keyCode : e.which);

        if (keycode == '13') {
            var code = $(this).val()
            console.log(code)
            const datos = {"cambioCodigoDos":code}
            $.ajax({
                type: "POST",
                url: "views/ajax/ficcion.php",
                data: datos,
            })
            .then(function(data){
                if (data == "ok") {
                    swal({
                        title: "¡OK!",
                        text: "¡El cambio se ha hecho correctamente!",
                        icon: "success",
                    })
                    .then((result) => {
                        if (result) {
                            window.location = "cambioPelicula"
                        }else{
                            window.location = "cambioPelicula"
                        }
                    })
                }else{
                    swal({
                        title: "Error!",
                        text: "Hemos tenido errores tecnicos",
                        icon: "error",
                    })
                    .then((result) => {
                        if (result) {
                            window.location = "cambioPelicula"
                        }else{
                            window.location = "cambioPelicula"
                        }
                    })
                }
            })
            
        }
    })
//aquiii
     $(".editarClientePelicula").on('click',function(e) {      

        
            var cedulaCliente = $(this).children().val()
            
            const datos = {"cedulaCliente":cedulaCliente}
            $.ajax({
                type: "POST",
                url: "views/ajax/ficcion.php",
                data: datos,
            })
            .then(function(data){
              if (data == null) {
                swal({
                    title: "¡Error!",
                    text: "¡El cliente no existe :(",
                    icon: "error",
                })
                .then((result) => {
                    if (result) {
                        window.location = "editarCliente"
                    }else{
                        window.location = "editarCliente"
                    }
                }) 
              }else{
                var datos = Object.values(data);
                console.log(datos)
                $(".cambioPelicula").hide()
                $(".clienteOcultar").show()
                $(".inputClient").val(cedulaCliente)
                $(".CeduCliente").val(cedulaCliente)
                for (var i = 0; i < datos.length; i++) {
                     var app = `<tr  style="text-align: center;">
                            <th>${datos[i].codigo}</th>
                            <th>${datos[i].nombrePelicula}</th>
                            <th>${datos[i].genero}</th>
                            <th class="quitarPeli" style="text-align: center;"><input type="text" hidden value="${datos[i].codigo}"><i style="font-size: 20px;cursor: pointer;" class="fa fa-arrow-left"></i></th>
                          </tr>`
                          $(".tbodyCliente").append(app)
                }
                $(".agregarPeli").on("click" , function(){
                    var codigo = $(this).children().next().val()
                    var cedula = $(this).children().val()
                    const datos= {"codigoIngresoCliente":codigo,"cedulaIngresoCliente":cedula}
                     $.ajax({
                            type: "POST",
                            url: "views/ajax/ficcion.php",
                            data: datos,
                        })

                     .then(function(data){
                        var datos = Object.values(data)
                        for (var i = 0; i < datos.length; i++) {
                                 var app = `<tr  style="text-align: center;">
                                        <th>${datos[i].codigo}</th>
                                        <th>${datos[i].nombrePelicula}</th>
                                        <th>${datos[i].genero}</th>
                                        <th class="quitarPeli" style="text-align: center;"><input type="text" hidden value="${datos[i].codigo}"><i style="font-size: 20px;cursor: pointer;" class="fa fa-arrow-left"></i></th>
                                      </tr>`
                                      $(".tbodyCliente").append(app)
                            }
                            $(".quitarPeli").on("click" , function(){
                                var codigo = $(this).children().val()
                                var cedula = $(".inputCeduClient").val()
                                const datos= {"codigoQuitarCliente":codigo,"cedulaQuitarCliente":cedula}
                                var este = $(this)
                                
                                
                                 $.ajax({
                                        type: "POST",
                                        url: "views/ajax/ficcion.php",
                                        data: datos,
                                    })
                                 
                                 .then(function(data){
                                    este.parent().remove()
                                    
                                 })
                             })
                     })
                })
                $(".quitarPeli").on("click" , function(){
                                var codigo = $(this).children().val()
                                var cedula = $(".inputCeduClient").val()
                                const datos= {"codigoQuitarCliente":codigo,"cedulaQuitarCliente":cedula}
                                var este = $(this)
                                
                                
                                 $.ajax({
                                        type: "POST",
                                        url: "views/ajax/ficcion.php",
                                        data: datos,
                                    })
                                 
                                 .then(function(data){
                                    este.parent().remove()
                                    
                                 })
                    })
                
                }         
            })
        

    })

    $('.editarCliente').on('click', function(){

        var cedula = $(this).children().val();
        
        const datos= {"cedulaEditarCliente":cedula}
        $.ajax({
            type: "POST",
            url: "views/ajax/ficcion.php",
            data: datos,
        })
        .then(function(data){

            var datos = Object.values(data);
            console.log(datos[0].nombre)
            $('.thisHidden').hide()
            $('.clienteOcultar').show()
            $('.editNombre').val(datos[0].nombre)
            $('.editCedula').val(datos[0].cedula)
            $('.editCedulaQueTal').val(datos[0].cedula)
            $('.editTelefono').val(datos[0].telefono)
            $('.editCorreo').val(datos[0].correo)
            $('.editDireccion').val(datos[0].direccion)

            $('.EditadoCliente').on('click', function(e){
                e.preventDefault();
                var cedulaVieja = $('.editCedulaQueTal').val()
                var cedulaNueva = $('.editCedula').val()
                var nombre = $('.editNombre').val()
                var telefono = $('.editTelefono').val()
                var correo = $('.editCorreo').val()
                var direccion = $('.editDireccion').val()
                
                const datosDos = 
                            {
                                "cedulaVieja":cedulaVieja,
                                "cedulaNueva":cedulaNueva,
                                "nombre":nombre,
                                "telefono":telefono,
                                "correo":correo,
                                "direccion":direccion
                            }
                            

                $.ajax({
                    type: "POST",
                    url: "views/ajax/ficcion.php",
                    data: datosDos,
                })
                .then(function(data){
                    if (data==false) {
                        swal({
                        title: "¡Error!",
                        text: "¡La cedula esta repetida!",
                        icon: "error",
                    })
                    .then((result) => {
                        if (result) {
                            window.location = "editarCliente"
                        }else{
                            window.location = "editarCliente"
                        }
                    })
                    }
                    else{
                    swal({
                        title: "¡Bien!",
                        text: "¡El cliente se ha editado",
                        icon: "success",
                    })
                    .then((result) => {
                        if (result) {
                            window.location = "editarCliente"
                        }else{
                            window.location = "editarCliente"
                        }
                    })}
                })
            })
        })
    })
    
    $('.deleteCliente').on('click', function(){
        $(this).parent().addClass('este');
        var cedulaCliente = $(this).children().val()
        const datos= {"cedulaEliminarCliente":cedulaCliente}
         $.ajax({
            type: "POST",
            url: "views/ajax/ficcion.php",
            data: datos,
        })
        .then(function(data){
            $('.este').hide('slow');
        })
    })

    $('.EliminarVenta').on('click', function(){
        var idEliminar = $(this).parent().children().val();        
        var that = $(this).parent().parent();
        var total = $(this).parent().prev().text();
        var comision = $(this).parent().prev().prev().text();
        var ganancia = $(this).parent().prev().prev().prev().text();
        
        // Clase para la comision en tabla de empleados
        var empleada = $(this).parent().prev().prev().prev().prev().prev().text();
        var cedulaEmpleado = $(this).parent().prev().prev().prev().prev().prev().children().val()
        var comisionParaRestar =  $("."+cedulaEmpleado).text()
        var totalResta = parseFloat(comisionParaRestar) -  parseFloat(comision)
        $("."+cedulaEmpleado).text(totalResta) 

        var totalAnterior = $(".cambiarTotal").text();
        var comisionAnterior = $(".cambiarComision").text();
        var gananciaAnterior = $(".cambiarGanancia").text();

        var totalReal =  parseFloat(totalAnterior) - parseFloat(total);
        var comisionReal = parseFloat(comisionAnterior) - parseFloat(comision);
        var gananciaReal = parseFloat(gananciaAnterior) - parseFloat(ganancia);



        const datos= {"idEliminar":idEliminar, "comisionRestar":empleada, "comision":comision}
         $.ajax({
            type: "POST",
            url: "views/ajax/ficcion.php",
           data: datos,
        })
        .then(function(data){
            console.log(data)
            that.hide();
            $(".cambiarTotal").text(totalReal);
            $(".cambiarComision").text(comisionReal);
            $(".cambiarGanancia").text(gananciaReal);
            $('.inputTotal').val(totalReal);

       })
    })

$(".reload").on("click",function(){
    $(".conteoServ").text(0)
    $(".inputVent").val("")

})    

$(".selectEmpleada").on("click" , function(){
    $('.ComisionEscondida').val($(this).children().children().val())
    $(".inputServicio").val($(this).children().next().prev().text())
})

$(".selectServ").on("click" , function(){
    var servicio = $(this).children().children().val()
    var servicioAnterior = $('.ServicioEscondido').val()
    if (servicioAnterior == "") {
        $('.ServicioEscondido').val(servicio)
    }else{
        $('.ServicioEscondido').val(servicioAnterior+"-"+servicio)
    }
    
    var input = $(".inputVent").val()
    if (input == ""){
        input= 0
    }
    var seleccion =  $(this).children().next().next().text()
    $(".inputVent").val(parseFloat(input) + parseFloat(seleccion))
    var conteoAnterio = $(this).children().next().children().text();
    $(this).children().children().text(parseFloat(conteoAnterio) + 1)

})
    
$(".print").on("click", function(){
    $(".navbar-toggler").hide()
    $(this).hide();
    print()
    location.reload()
})

$(".reportado").on("click", function(){
    var cedula = $(this).children().val()
    console.log(cedula)
    const datosDos ={"cedula":cedula}

                $.ajax({
                    type: "POST",
                    url: "views/ajax/ficcion.php",
                    data: datosDos,
                })
                .then(function(data){
                    var datos = Object.values(data)
                    if (datos.length != "0" ) {
                        
                        var gananciaTotal = 0
                        var comisionTotal = 0
                        var Total = 0
                        var trabajador = datos[0].trabajador
                        for (var i = 0; i < datos.length; i++) {
                            
                        

                     gananciaTotal = parseFloat(gananciaTotal) + parseFloat(datos[i].ganancia);
                     comisionTotal = parseFloat(comisionTotal) + parseFloat(datos[i].comision);
                     Total = parseFloat(Total) + parseFloat(datos[i].total);
                        var report = `<tr>
                        <td style="text-align: center; font-size:10px;padding: 2px;color:black !important;">${datos[i].servicio}</td>
                        <td style="text-align: center; font-size:10px;padding: 2px;color:black !important;">${datos[i].comision}</td>
                    </tr>   
                    
                        `
                    $(".tBodyReport").append(report)
                    }
                    var totalFuera = `<tr>
                        <td style="text-align: center;color:black !important">TOTAL</td>
                        <td style="text-align: center;color:black !important">${comisionTotal}</td>
                    </tr>`
                    $(".tBodyReport").append(totalFuera)
                    $(".container").hide()
                    $(".maldito").show()
                     $(".navbar-toggler").hide()
                     $(".reporteEmple").text("Reporte Total de " + trabajador)
                    print()
                    location.reload()
                }else{
                    swal({
                        title: "¡Error!",
                        text: "¡La empleada no tiene ventas!",
                        icon: "error",
                    })
                }
            })
})



})(jQuery);