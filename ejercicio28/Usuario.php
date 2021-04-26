<?php

    include "AccesoDatos.php";

    class Usuario
    {
        public $_nombre;
        public $_apellido;
        public $_clave;
        public $_mail;
        public $_fechaRegistro;
        public $_localidad;

        public function __construct ($nombre,$apellido,$clave,$mail,$localidad)
        {
            $this -> _nombre = $nombre;
            $this -> _apellido = $apellido;
            $this -> _clave = $clave;
            $this -> _mail = $mail;
            //$this -> _id = rand(1,10000);
            $this -> _fechaRegistro = date("Y-m-d");
            $this -> _localidad = $localidad;
        }

        public function AgregarUsuario()
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            
            $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into usuario (nombre,apellido,clave,mail, fecha_de_registro,localidad)values('$this->_nombre','$this->_apellido','$this->_clave','$this->_mail','$this->_fechaRegistro','$this->_localidad')");
            
            $consulta->execute();
			
            return $objetoAccesoDato->RetornarUltimoIdInsertado();
        }

        public static function ListarDatos ()
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            
            $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM usuario");
            $consulta->execute();

            $strHTML="<ul>";

            while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) 
            {
                $strHTML.= "<li>". $fila['nombre'] . ", ". $fila['apellido'].", ". $fila['clave'].", ". $fila['mail'].", ".$fila['fecha_de_registro'].", ".$fila['localidad']."</li>"; 
            }

            $strHTML.="</ul>";

            return $strHTML; 

            /*             
            while ($arr = $consulta->fetch(PDO::FETCH_ASSOC)) 
            {
                echo $arr['nombre'] . "\n";
                echo $arr['apellido']. "\n";
                echo $arr['clave']. "\n";
                echo $arr['mail']. "\n";
                echo $arr['fecha_de_registro']. "\n";
                echo $arr['localidad']. "\n". "\n";
             }
             */ 
        }
    }

?>