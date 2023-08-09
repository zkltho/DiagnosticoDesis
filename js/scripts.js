$(document).ready(function() {
    //validacion Rut        
    var Fn = {
        // Valida el rut con su cadena completa "XXXXXXXX-X"
        validaRut : function (rutCompleto) {
            rutCompleto = rutCompleto.replace("‐","-");
            if (!/^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test( rutCompleto ))
                return false;
            var tmp 	= rutCompleto.split('-');
            var digv	= tmp[1]; 
            var rut 	= tmp[0];
            if ( digv == 'K' ) digv = 'k' ;
            
            return (Fn.dv(rut) == digv );
        },
        dv : function(T){
            var M=0,S=1;
            for(;T;T=Math.floor(T/10))
                S=(S+T%10*(9-M++%6))%11;
            return S?S-1:'k';
        }
    }
       
        
    $("#formVotar").submit(function(event) {
        event.preventDefault(); // Prevenir el envío del formulario por defecto
        var selectedCheckboxes = $("input[type='checkbox']:checked").length;

        var formData = $(this).serialize(); // Obtener los datos del formulario
        console.log(formData);
        if (!validarAlias($(alias).val())) {
            alert("El alias debe tener al menos 5 caracteres y contener letras y números");
            return; // Detener el proceso si el alias no es válido
        }
        if (!Fn.validaRut($(rut).val())) {
            alert("El rut debe cumplir con el formato 00000000-0");
            return; // Detener el proceso si el rut no es válido
        }
        
        if (!validarFormatoCorreo($(email).val())) {
            alert("El formato del correo electrónico no es válido");
            return; // Detener el proceso si el email no es válido
        }
            
        if (selectedCheckboxes < 1) {
            alert("Selecciona al menos dos opciones");
            return; // Detener el proceso si no selecciona 2 opciones
        }

        $.ajax({
            type: "POST",
            url: "guardar.php", // Archivo PHP para procesar y guardar los datos
            data: formData,
            success: function(response) {
                alert(response.message);
            },
            error: function() {
                alert("Error al registrar el voto");
            }
        });
    });
    //Iniciando el select regiones en una posicion para asi cargar el select de comunas
    $('#region').val(1);
    recargarLista();

    $('#region').change(function(){
        recargarLista();
    });

    //funcion que actualiza el select de comunas segun la region seleccionada
    function recargarLista(){
        $.ajax({
            type:"POST",
            url:"datos.php",
            data:"region="+$('#region').val(),
            dataType:"json",
            success:function(r){                
                var $comunaSelector = $("#comuna");
                    $comunaSelector.empty();
                    $comunaSelector.append('<option value="">Seleccione una comuna</option>');
                    $.each(r, function(key, value) {
                        $("#comuna").append('<option value="' + value.comuna_id + '">' + value.comuna_nombre + '</option>');
                    });
            }
        });
    };

    //validacion del campo Alias
    function validarAlias(alias) {        
        
        var regex = /^(?=.*[a-zA-Z])(?=.*\d).{6,}$/;
        
        if (alias.length > 5 && regex.test(alias)) {
            return true;
        } else {
            return false;
        }
    }
    
    //validacion del Email
    function validarFormatoCorreo(correo) {        
        var formatoValido = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/.test(correo);
        return formatoValido;
    }

});