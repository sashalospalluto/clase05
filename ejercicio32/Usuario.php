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
            //$registro = $consulta->fetchAll();
            			
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
        }

        public function BuscarUsuario()
        {         
            if($this-> ValidarMail())
            {
                $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();                     
    
                $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM usuario WHERE clave =:clave AND mail=:mail"); 
    
                $consulta->bindValue(':clave', $this->_clave, PDO::PARAM_INT);
                $consulta->bindValue(':mail', $this->_mail, PDO::PARAM_STR);
    
                $consulta->execute(); 
    
                $registro = $consulta->fetch();
                //$registro = $consulta->fetchAll();
                //$consulta->closeCursor();
                
                if($registro)
                {
                    $respuesta = 1;
                }
                else
                {
                    $respuesta = 0;
                }
            }
            else
            {
                $respuesta = -1;
            }

            return $respuesta;
        } 

        public function ValidarMail()
        {
            $respuesta = false;

            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM usuario WHERE mail=:mail"); 

            $consulta->bindValue(':mail', $this->_mail, PDO::PARAM_STR);

            $consulta->execute(); 

            $registro = $consulta->fetch();
            //$registro = $consulta->fetchAll();

            if($registro)
            {
                $respuesta = true;
            }

            return $respuesta;
        }

        public static function ValidarID($idABuscar)
        {
            $respuesta = false;

            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM usuario WHERE id=:id"); 

            $consulta->bindValue(':id', $idABuscar, PDO::PARAM_STR);

            $consulta->execute(); 

            $registro = $consulta->fetch();
            //$registro = $consulta->fetchAll();

            if($registro)
            {
                $respuesta = true;
            }

            return $respuesta;
        }

        public function ValidarNombre()
        {
            $respuesta = false;

            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM usuario WHERE nombre=:nombre"); 

            $consulta->bindValue(':nombre', $this->_nombre, PDO::PARAM_STR);

            $consulta->execute(); 

            $registro = $consulta->fetch();
            //$registro = $consulta->fetchAll();

            if($registro)
            {
                $respuesta = true;
            }

            return $respuesta;
        }

        public function CambiarClave($clavenueva)
        {
            $respuesta = false;

            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE usuario SET clave =:clave WHERE nombre =:nombre AND mail=:mail;"); 

            $consulta->bindValue(':clave', $clavenueva, PDO::PARAM_STR);
            $consulta->bindValue(':nombre', $this->_nombre, PDO::PARAM_STR);
            $consulta->bindValue(':mail', $this->_mail, PDO::PARAM_STR);

            if($consulta->execute())
            {
                $respuesta = true;
            }

            return $respuesta;
        }
    }

?>