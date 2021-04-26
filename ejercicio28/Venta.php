<?php

    //include "AccesoDatos.php";

    class Venta
    {
        public static function ListarDatos ()
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            
            $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM venta");
            $consulta->execute();

            $strHTML="<ul>";

            while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) 
            {
                $strHTML.= "<li>". $fila['id'] . ", ". $fila['id_producto'].", ". $fila['id_usuario'].", ". $fila['cantidad'].", ".$fila['fecha_de_venta']."</li>"; 
            }

            $strHTML.="</ul>";

            return $strHTML;            
        } 
    }