$(document).ready(function(){
    $('#calcular-total').click(function(){
        $('#resultados').load('php/calcular_total.php');
    });

    $('#calcular-marca').click(function(){
        $('#resultados').load('php/calcular_marca.php');
    });

    $('#calcular-estanteria').click(function(){
        $('#resultados').load('php/calcular_estanteria.php');
    });

    $('#agregar-producto').click(function(){
        $('#resultados').load('php/agregar_producto.php');
    });

    $('#eliminar-producto').click(function(){
        $('#resultados').load('php/eliminar_producto.php');
    });

    $('#mostrar-info').click(function(){
        $('#resultados').load('php/mostrar_info.php');
    });
    
});
