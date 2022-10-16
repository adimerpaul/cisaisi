$( document ).ready(function() {
    $('#formulario').submit(function(event){
        event.preventDefault();
        //add stuff here
    });
    $('#ciestudiante').keyup(function(event){
        var ciestudiante=$('#ciestudiante').val()

        //console.log();
        var datos={
            "mostrar":"nombre",
            "tabla":"estudiante",
            "where":"ciestudiante",
            "dato":ciestudiante
        };
        $.ajax({
            url:'inscribir/consulta',
            data:datos,
            type:'POST',
            success:function (e) {
                if (e.length<40){
                    $('#mensaje').html(e);
                    $('#ciestudiante').val('');
                    $('#foto').prop('src','fotos/'+ciestudiante+'.jpg');
                    $('#credencial').prop('href','Acreditacion/credencial/'+ciestudiante);
                    datos.mostrar="idinscripcion";
                    datos.tabla="inscripcion";
                    datos.where="ciestudiante";
                    datos.dato=ciestudiante;
                    $.ajax({
                        url:'inscribir/consulta',
                        data:datos,
                        type:'POST',
                        success:function (e) {
                            var idinscripcion=e;
                            $('#idinscripcion').val(idinscripcion);
                            datos.mostrar="idinscripcion";
                            datos.tabla="materialinscripcion";
                            datos.where="idinscripcion";
                            datos.dato=idinscripcion;
                            $.ajax({
                                url:'inscribir/consulta',
                                data:datos,
                                type:'POST',
                                success:function (e) {
                                    if(e.length<4){
                                        $('#verificacion').html('¡¡¡YA ACREDITADO!!!!');
                                    }else{
                                        $('#verificacion').html('');
                                    }
                                }
                            });
                        }
                    });
                }else{
                    $('#mensaje').html('NO encontrado');
                    $('#foto').prop('src','assets/images/!logged-user.jpg');
                    $('#verificacion').html('');
                    $('#idinscripcion').val('');
                }
            }
        });

    });

});