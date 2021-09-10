<?php
/*
clase que representa a la entidad Usuario
*/
abstract class Document{

    //-------------------------
    //Atributos
    //-------------------------
    /*
    Representa la clave de acceso del Usuario
    */
    protected $id;
    /*
    Representa la clave de acceso del Usuario
    */
    protected $title;
    /*
    Representa la clave de acceso del Usuario
    */
    protected $authors;
    /*
    Representa el correo electronico del Usuario
    */
    protected $ISBN;
    /*
    Representa el nombre del Usuario
    */
    protected $datePublished;
        /*
    Representa el nombre del Usuario
    */
    protected $editorial;
    /*
    Representa el nombre del Usuario
    */
    protected $available;
        /*
    Representa el nombre del Usuario
    */
    protected $url;
    /*
    Representa el nombre del Usuario
    */
    protected $description;
    /*
    Representa el nombre del Usuario
    */
    protected $idUser;

    protected $quantity;



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
    public function getTitle(){
        return $this->title;
    }
    /**
    * Método para cambiar la clave de acceso del Usuario
    * @param [String] clave de acceso del Usuario
    */
    public function setTitle($title){
        $this->title = $title;
    }
    /**
    * Método para obtener la clave de acceso del Usuario
    * @return [String] clave de acceso del Usuario
    */
    public function getAuthors(){
        return $this->authors;
    }
    /**
    * Método para cambiar la clave de acceso del Usuario
    * @param [String] clave de acceso del Usuario
    */
    public function setAuthors($authors){
        $this->authors = $authors;
    }
    /**
     * Método para obtener el correo electronico del Usuario
     * @return [String] correo del Usuario
    */
    public function getISBN(){
        return $this->ISBN;
    }
    /**
     * Método para obtener el correo electronico del Usuario
     * @param [String] correo del Usuario
     */
    public function setISBN($ISBN){
        $this->ISBN = $ISBN;
    }
    /**
     * Método para obtener  el name del Usuario
     * @return [String] name del Usuario
     */
    public function getDatePublished(){
        return $this->datePublished;
    }
    /**
     * Método para cambiar  el Name del Usuario
    * @param [String] Name del Usuario
    */
    public function setDatePublished($datePublished){
        $this->datePublished = $datePublished;
    }
        /**
     * Método para obtener  el name del Usuario
     * @return [String] name del Usuario
     */
    public function getEditorial(){
        return $this->editorial;
    }
    /**
     * Método para cambiar  el Name del Usuario
    * @param [String] Name del Usuario
    */
    public function setEditorial($editorial){
        $this->editorial = $editorial;
    }
        /**
     * Método para obtener  el name del Usuario
     * @return [String] name del Usuario
     */
    public function getAvailable(){
        return $this->available;
    }
    /**
     * Método para cambiar  el Name del Usuario
    * @param [String] Name del Usuario
    */
    public function setAvailable($available){
        $this->available = $available;
    }
        /**
     * Método para obtener  el name del Usuario
     * @return [String] name del Usuario
     */
    public function getUrl(){
        return $this->url;
    }
    /**
     * Método para cambiar  el Name del Usuario
    * @param [String] Name del Usuario
    */
    public function setUrl($url){
        $this->url = $url;
    }
        /**
     * Método para obtener  el name del Usuario
     * @return [String] name del Usuario
     */
    public function getDescription(){
        return $this->description;
    }
    /**
     * Método para cambiar  el Name del Usuario
    * @param [String] Name del Usuario
    */
    public function setDescription($description){
        $this->description = $description;
    } 
    /**
     * Método para obtener  el name del Usuario
     * @return [String] name del Usuario
     */
    public function getIdUser(){
        return $this->idUser;
    }
    /**
     * Método para cambiar  el Name del Usuario
    * @param [String] Name del Usuario
    */
    public function setIdUser($idUser){
        $this->idUser = $idUser;
    }
    public function getQuantity(){
        return $this->quantity;
    }
    /**
     * Método para cambiar  el Name del Usuario
    * @param [String] Name del Usuario
    */
    public function setQuantity($quantity){
        $this->quantity = $quantity;
    }
}
?>