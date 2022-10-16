$('#ciestudiante').keyup(function() {
    //console.log($('#ciestudiante').val());
    var datos={
        "mostrar":"nombre",
        "tabla":"estudiante",
        "where":"ciestudiante",
        "dato":$("#ciestudiante").val()
    };
    $.ajax({
        url:'inscribir/consulta',
        data:datos,
        type:'POST',
        success:function (e) {
            if (e.length<40)
                $('#mensaje').html('perteneciente a '+e);
            else
                $('#mensaje').html('');
        }
    });
});

$('#estudianteinterno').change(function () {
    var datos={
        "mostrar":"carrera",
        "tabla":"estudiante",
        "where":"ciestudiante",
        "dato":$("#estudianteinterno option:selected").val()
    };
    //console.log($("#estudianteinterno option:selected").val());
    $('#ciestudiante').val($("#estudianteinterno option:selected").val());

    $('#foto').prop('src','fotos/'+$('#ciestudiante').val()+'.jpg');
    $('#contenedorfoto').prop('href','fotos/'+$('#ciestudiante').val()+'.jpg');



    $.ajax({
        url:'inscribir/consulta',
        data:datos,
        type:'POST',
        success:function (e) {
            $('#carrera').val(e);
        },beforeSend:function () {
            $('#carrera').val('Cargando...');
        }
    });
    datos.mostrar="sede";
    $.ajax({
        url:'inscribir/consulta',
        data:datos,
        type:'POST',
        success:function (e) {
            $('#sede').val(e);
        },beforeSend:function () {
            $('#sede').val('Cargando...');
        }
    });
    datos.mostrar="correo";
    $.ajax({
        url:'inscribir/consulta',
        data:datos,
        type:'POST',
        success:function (e) {
            $('#email').val(e);
        },beforeSend:function () {
            $('#email').val('Cargando...');
        }
    });
    datos.mostrar="sede";
    $.ajax({
        url:'inscribir/consulta',
        data:datos,
        type:'POST',
        success:function (e) {
            $('#sede').val(e);
        },beforeSend:function () {
            $('#sede').val('Cargando...');
        }
    });
    datos.mostrar="celular";
    $.ajax({
        url:'inscribir/consulta',
        data:datos,
        type:'POST',
        success:function (e) {
            $('#celular').val(e);
        },beforeSend:function () {
            $('#celular').val('Cargando...');
        }
    });

    datos.mostrar="monto";
    datos.tabla="inscripcion";
    $.ajax({
        url:'inscribir/consulta',
        data:datos,
        type:'POST',
        success:function (e) {
            if(e.length<4)
                $('#monto1').val(e);
            else
                $('#monto1').val('');
        },beforeSend:function () {
            $('#monto1').val('Cargando...');
        }
    });

    datos.mostrar="monto2";
    datos.tabla="inscripcion";
    $.ajax({
        url:'inscribir/consulta',
        data:datos,
        type:'POST',
        success:function (e) {
            if(e.length<4)
                $('#monto2').val(e);
            else
                $('#monto2').val('');
        },beforeSend:function () {
            $('#monto2').val('Cargando...');
        }
    });
    datos.mostrar="tipo";
    $.ajax({
        url:'inscribir/consulta',
        data:datos,
        type:'POST',
        success:function (e) {
            $('#tipo').val(e);
        },beforeSend:function () {
            $('#tipo').val('Cargando...');
        }
    });
});
/*var estudianteinterno = document.getElementById('estudianteinterno');
estudianteinterno.addEventListener('change',
    function(){
        var selectedOption = this.options[estudianteinterno.selectedIndex];
        console.log(selectedOption.value + ': ' + selectedOption.text);
    });
    */


$('#modificar').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    $('#monto1m').val(button.data('monto1'));
    $('#monto2m').val(250-button.data('monto1'));
    //$('#faltante').html(250-button.data('monto1'));
    $('#fotom').prop('src','fotos/'+button.data('ciestudiante')+'.jpg');
    $('#contenedorfotom').prop('href','fotos/'+button.data('ciestudiante')+'.jpg');
    $('#ciestudiantem').prop('value',button.data('ciestudiante'));
})