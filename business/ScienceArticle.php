<?php
/*
clase que representa a la entidad Usuario
*/
require_once($_SERVER["DOCUMENT_ROOT"]).'/Amazonia/business/Document.php';
class ScienceArticle extends Document{

    //-------------------------
    //Atributos
    //-------------------------
    /*
    Representa numero de paginas
    */
    private $SSN;


    //----------------------------
    //Constructor
    //----------------------------
    /*
    Representa un constructor vacio para la clase Usuario
    */
    function __construct(){

    }
    /**
    * Método para obtener la clave de acceso del Usuario
    * @return [String] clave de acceso del Usuario
    */
    public function getSSN(){
        return $this->SSN;
    }
    /**
    * Método para cambiar la clave de acceso del Usuario
    * @param [String] clave de acceso del Usuario
    */
    public function setSSN($SSN){
        $this->SSN = $SSN;
    }
    
}
?>