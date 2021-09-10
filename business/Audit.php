<?php
/*
clase que representa a la entidad Usuario
*/
class Audit{

    //-------------------------
    //Atributos
    //-------------------------
    /*

    Representa la clave de acceso del Usuario
    */
    private $cod_audit;
    /*
    Representa la clave de acceso del Usuario
    */
    private $cod_user;
    /*
    Representa el correo electronico del Usuario
    */
    private $audit_date;
    /*
    Representa el status del Usuario: activo/inactivo
    */
    private $action;
    /*
    Representa el nombre del Usuario
    */
    private $table_affected;

    private $cod_affected;

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
    public function getCod_audit(){
        return $this->cod_audit;
    }
    /**
    * Método para cambiar la clave de acceso del Usuario
    * @param [String] clave de acceso del Usuario
    */
    public function setCod_audit($cod_audit){
        $this->cod_audit = $cod_audit;
    }
    /**
    * Método para obtener la clave de acceso del Usuario
    * @return [String] clave de acceso del Usuario
    */
    public function getCod_user(){
        return $this->cod_user;
    }
    /**
    * Método para cambiar la clave de acceso del Usuario
    * @param [String] clave de acceso del Usuario
    */
    public function setCod_user($cod_user){
        $this->cod_user = $cod_user;
    }
    /**
     * Método para obtener el correo electronico del Usuario
     * @return [String] correo del Usuario
    */
    public function getAudit_date(){
        return $this->audit_date;
    }
    /**
     * Método para obtener el correo electronico del Usuario
     * @param [String] correo del Usuario
     */
    public function setAudit_date($audit_date){
        $this->audit_date = $audit_date;
    }
    /**
     * Método para obtener el status del Usuario (1:Activo/0:Inactivo)
     * @return [integer] status del Usuario
     */
    public function getAction(){
        return $this->action;
    }
    /**
     * Método para cambiar el action del Usuario 
    * @param [integer] action del Usuario
    */
    public function setAction($action){
        $this->action = $action;
    }
    /**
     * Método para obtener  el name del Usuario
     * @return [String] name del Usuario
     */
    public function getTable_affected(){
        return $this->table_affected;
    }
    /**
     * Método para cambiar  el table_affected del Usuario
    * @param [String] table_affected del Usuario
    */
    public function setTable_affected($table_affected){
        $this->table_affected = $table_affected;
    }
    /**
     * Método para obtener el status del Usuario (1:Activo/0:Inactivo)
     * @return [integer] status del Usuario
     */
    public function getCod_affected(){
        return $this->cod_affected;
    }
    /**
     * Método para cambiar el cod_affected del Usuario 
    * @param [integer] cod_affected del Usuario
    */
    public function setCod_affected($cod_affected){
        $this->cod_affected = $cod_affected;
    }
}
?>