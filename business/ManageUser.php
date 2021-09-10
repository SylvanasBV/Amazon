<?php
    /**
     * Importe de clases
     */
    require_once($_SERVER["DOCUMENT_ROOT"]).'/Amazonia/persistence/util/Connection.php';
    require_once($_SERVER["DOCUMENT_ROOT"]).'/Amazonia/persistence/UserDAO.php';

    class ManageUser{


        /**
         * Atributo para la conexión a la base de datos
         */
        private static $connection;

        function __construct(){

        }

        /**
         * Obtiene un useristrador
        * @param  [String] $user [Nombre de user del useristrador a buscar]
        * @return [useristrador] useristrador encontrado
        */
        public static function consult($id){

            $userDAO=UserDAO::getUserDAO(self::$connection);
            $user=$userDAO->consult($id);
            return $user;

        }
        /**
         * Obtiene un useristrador
        * @param  [String] $user [Nombre de user del useristrador a buscar]
        * @return [useristrador] useristrador encontrado
        */
        public static function consultByMail($email){
            $userDAO=UserDAO::getUserDAO(self::$connection);
            $user=$userDAO->consultByMail($email);
            return $user;

        }
        /**
         * Crea un nuevo useristrador
         * @param user useristrador a ingresar
         * @return void
         */
        public static function createUser($user){
            $userDAO=userDAO::getUserDAO(self::$connection);
            $userDAO->create($user);

        }

        public static function login($email, $password) {
            $userDAO = userDAO::getUserDAO(self::$connection);
            $user=$userDAO->consultByMail($email);
            $pass=$user->getPassword();

            if (password_verify($password,$pass)) {
                return $user;
            } else {
                return '';
            }
        }
        /**
         * Lista todos los useristradores
         * @return user[] Lista de todos los useristradores de la base de datos
         */
        public  static function listAll(){
            $userDAO = userDAO::getUserDAO(self::$connection);
            $users=$userDAO->listAll();
            return $users;
        }


        /**
         * Modifica un useristrador
         * @param user useristrador a modificar
         * @return void
         */
        public static function modify($user){
            $userDAO=userDAO::getUserDAO(self::$connection);
            $userDAO->modify($user);
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
