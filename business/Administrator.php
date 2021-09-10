<?php
/*
clase que representa a la entidad Usuario
*/
class Administrator{
//-------------------------
//Atributos
//-------------------------
//-------------------------
    //Atributos
    //-------------------------
    /*
    Representa la clave de acceso del Usuario
    */
    private $id;
    /*
    Representa la clave de acceso del Usuario
    */
    private $password;
    /*
    Representa el correo electronico del Usuario
    */
    private $email;
    /*
    Representa el status del Usuario: activo/inactivo
    */
    private $status;
    /*
    Representa el nombre del Usuario
    */
    private $name;
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
    public function getId(){
        return $this->id;
    }
    /**
    * Método para cambiar la clave de acceso del Usuario
    * @param [String] clave de acceso del Usuario
    */
    public function setId($id){
        $this->id = $id;
    }
    /**
    * Método para obtener la clave de acceso del Usuario
    * @return [String] clave de acceso del Usuario
    */
    public function getPassword(){
        return $this->password;
    }
    /**
    * Método para cambiar la clave de acceso del Usuario
    * @param [String] clave de acceso del Usuario
    */
    public function setPassword($password){
        $this->password = $password;
    }
    /**
     * Método para obtener el correo electronico del Usuario
     * @return [String] correo del Usuario
    */
    public function getEmail(){
        return $this->email;
    }
    /**
     * Método para obtener el correo electronico del Usuario
     * @param [String] correo del Usuario
     */
    public function setEmail($email){
        $this->email = $email;
    }
    /**
     * Método para obtener el status del Usuario (1:Activo/0:Inactivo)
     * @return [integer] status del Usuario
     */
    public function getStatus(){
        return $this->status;
    }
    /**
     * Método para cambiar el status del Usuario 
    * @param [integer] status del Usuario
    */
    public function setStatus($status){
        $this->status = $status;
    }
    /**
     * Método para obtener  el name del Usuario
     * @return [String] name del Usuario
     */
    public function getName(){
        return $this->name;
    }
    /**
     * Método para cambiar  el Name del Usuario
    * @param [String] Name del Usuario
    */
    public function setName($name){
        $this->name = $name;
    }
  
}
?>