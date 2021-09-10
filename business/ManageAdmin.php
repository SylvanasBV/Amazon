<?php
    /**
     * Importe de clases
     */
    require_once($_SERVER["DOCUMENT_ROOT"]).'/Amazonia/persistence/util/Connection.php';
    require_once($_SERVER["DOCUMENT_ROOT"]).'/Amazonia/persistence/AdminDAO.php';

    class ManageAdmin{


        /**
         * Atributo para la conexión a la base de datos
         */
        private static $connection;

        function __construct(){

        }

        /**
         * Obtiene un administrador
        * @param  [String] $admin [Nombre de admin del administrador a buscar]
        * @return [administrador] administrador encontrado
        */
        public static function consult($id){

            $adminDAO=AdminDAO::getAdminDAO(self::$connection);
            $admin=$adminDAO->consult($id);
            return $admin;

        }
        /**
         * Obtiene un administrador
        * @param  [String] $admin [Nombre de admin del administrador a buscar]
        * @return [administrador] administrador encontrado
        */
        public static function consultByMail($email){
            $adminDAO=AdminDAO::getAdminDAO(self::$connection);
            $admin=$adminDAO->consultByMail($email);
            return $admin;

        }
        /**
         * Crea un nuevo administrador
         * @param admin administrador a ingresar
         * @return void
         */
        public static function createAdmin($admin){
            $adminDAO=adminDAO::getAdminDAO(self::$connection);
            $adminDAO->create($admin);

        }

        public static function login($email, $password) {
            $adminDAO = adminDAO::getAdminDAO(self::$connection);
            $admin=$adminDAO->consultByMail($email);
            $pass=$admin->getPassword();

            if (password_verify($password,$pass)) {
                return $admin;
            } else {
                return '';
            }
        }
        /**
         * Lista todos los administradores
         * @return admin[] Lista de todos los administradores de la base de datos
         */
        public  static function listAll(){
            $adminDAO = adminDAO::getAdminDAO(self::$connection);
            $admins=$adminDAO->listAll();
            return $admins;
        }


        /**
         * Modifica un administrador
         * @param admin administrador a modificar
         * @return void
         */
        public static function modify($admin){
            $adminDAO=adminDAO::getAdminDAO(self::$connection);
            $adminDAO->modify($admin);
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
