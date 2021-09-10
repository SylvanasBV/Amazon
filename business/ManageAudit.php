<?php
    /**
     * Importe de clases
     */
    require_once($_SERVER["DOCUMENT_ROOT"]).'/Amazonia/persistence/util/Connection.php';
    require_once($_SERVER["DOCUMENT_ROOT"]).'/Amazonia/persistence/AuditDAO.php';

    class ManageAudit{


        /**
         * Atributo para la conexión a la base de datos
         */
        private static $connection;

        function __construct(){

        }

        /**
         * Obtiene un useristrador
        */
        public static function consult($id){

            $auditDAO=AuditDAO::getAuditDAO(self::$connection);
            $audit=$auditDAO->consult($id);
            return $audit;

        }
        
        /**
         * Crea un nuevo useristrador
         */
        public static function create($audit){
            $auditDAO=AuditDAO::getAuditDAO(self::$connection);
            $auditDAO->create($audit);

        }

        /**
         * Lista todos los useristradores
         */
        public  static function listAll(){
            $auditDAO = AuditDAO::getAuditDAO(self::$connection);
            $audits=$auditDAO->listAll();
            return $audits;
        }


        /**
         * Modifica un useristrador
         * @return void
         */
        public static function modify($audit){
            $auditDAO=AuditDAO::getAuditDAO(self::$connection);
            $auditDAO->modify($audit);
        }



        /**
         * Cambia la conexión
         */
        public static function setConnectionBD($connection)
        {
            self::$connection = $connection;
        }
    }

?>
