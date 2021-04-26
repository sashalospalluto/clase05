<?php

    //include "AccesoDatos.php";

    class Producto
    {
        public static function ListarDatos ()
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            
            $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM producto");
            $consulta->execute();

            $strHTML="<ul>";

            while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) 
            {
                $strHTML.= "<li>". $fila['codigo_de_barra'] . ", ". $fila['nombre'].", ". $fila['tipo'].", ". $fila['stock'].", ".$fila['precio'].", ".$fila['fecha_de_creacion'].", ".$fila['fecha_de_modificacion']."</li>"; 
            }

            $strHTML.="</ul>";

            return $strHTML;            
        } 
    }