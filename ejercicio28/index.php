<?php

    include "Usuario.php";
    include "Producto.php";
    include "Venta.php";

    $tipoDeArchivo = $_GET['tipo'];

    $tipoDeArchivo = strtolower($tipoDeArchivo);

    switch ($tipoDeArchivo)
    {
        case 'usuario':
            echo Usuario :: ListarDatos();
            break;

        case 'producto':
            echo Producto :: ListarDatos();
            break;

        case 'venta':
            echo Venta :: ListarDatos();
            break;

        default:
            echo "error";
            break;    
    }    

?>