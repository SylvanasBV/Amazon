<?php
    /**
     * Importe de clases
     */
    require_once($_SERVER["DOCUMENT_ROOT"]).'/Amazonia/persistence/util/Connection.php';
    require_once($_SERVER["DOCUMENT_ROOT"]).'/Amazonia/persistence/PresentationDAO.php';

    class ManagePresentation{

        /**
         * Atributo para la conexión a la base de datos
         */
        private static $connection;

        function __construct(){

        }

        /**
         * Obtiene un presentationistrador
        * @param  [String] $presentation [Nombre de presentation del presentationistrador a buscar]
        * @return [presentationistrador] presentationistrador encontrado
        */
        public static function consult($id){

            $presentationDAO=PresentationDAO::getPresentationDAO(self::$connection);
            $presentation=$presentationDAO->consult($id);
            return $presentation;

        }

        
        /**
         * Obtiene un presentationistrador
        * @param  [String] $presentation [Nombre de presentation del presentationistrador a buscar]
        * @return [presentationistrador] presentationistrador encontrado
        */
        public static function consultByUSer($id){

            $presentationDAO=PresentationDAO::getPresentationDAO(self::$connection);
            $presentation=$presentationDAO->consultByUser($id);
            return $presentation;

        }
        
        /**
         * Crea un nuevo presentationi
         * @param presentation presentationistrador a ingresar
         * @return void
         */
        public static function create($presentation){
            $presentationDAO=presentationDAO::getPresentationDAO(self::$connection);
            $presentationDAO->create($presentation);

        }

           /**
         * Lista todos los presentationistradores
         * @return presentation[] Lista de todos los presentationistradores de la base de datos
         */
        public  static function listAll(){
            $presentationDAO = presentationDAO::getPresentationDAO(self::$connection);
            $presentations=$presentationDAO->listAll();
            return $presentations;
        }

        public  static function listByQuery($query){
            $presentationDAO = presentationDAO::getPresentationDAO(self::$connection);
            $presentations=$presentationDAO->listByQuery($query);
            return $presentations;
        }


        /**
         * Modifica un presentationistrador
         * @param presentation presentationistrador a modificar
         * @return void
         */
        public static function modify($presentation){
            $presentationDAO=presentationDAO::getPresentationDAO(self::$connection);
            $presentationDAO->modify($presentation);
        }

        public  static function lastInsert(){
            $presentationDAO=presentationDAO::getPresentationDAO(self::$connection);
            $li=$presentationDAO->lastInsert();
            return $li;
        }



        /**
         * Cambia la conexión
         */
        public static function setConnectionBD($connection)
        {
            self::$connection = $connection;
        }
    }
