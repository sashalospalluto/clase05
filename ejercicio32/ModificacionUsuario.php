<?php

    include "Usuario.php";

    $nombre = $_POST['nombre'];
    $clavenueva = $_POST['claveNueva'];
    $clavevieja = $_POST['claveVieja'];
    $mail = $_POST['mail'];

    if($nombre!=null && $clavenueva!=null && $clavevieja!=null && $mail!=null)
    {
        $usuario = new Usuario($nombre,null,$clavevieja, $mail, null);

        $rta = $usuario->BuscarUsuario();
        if($rta==1)
        {
            if($usuario->ValidarNombre())
            {
                if($usuario->CambiarClave($clavenueva))
                {
                    echo "clave modificada";
                }
                else
                {
                    echo "error1";
                }
            }
            else
            {
                echo "error2";
            }
        
        }
        else
        {
            echo "error3" . $rta;
        }
    }
    else
    {
        echo "error4";
    }
?>