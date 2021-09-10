<?php
    /**
     * Importe de clases
     */
    require_once($_SERVER["DOCUMENT_ROOT"]).'/Amazonia/persistence/util/Connection.php';
    require_once($_SERVER["DOCUMENT_ROOT"]).'/Amazonia/persistence/BookingDAO.php';

    class ManageBooking{

        /**
         * Atributo para la conexión a la base de datos
         */
        private static $connection;

        function __construct(){

        }

        /**
         * Obtiene un bookistrador
        */
        public static function consult($cod_booking){

            $bookingDAO=BookingDAO::getBookingDAO(self::$connection);
            $booking=$bookingDAO->consult($cod_booking);
            return $booking;

        }

        public static function consultByUser($cod,$type,$cod_user){

            $bookingDAO=BookingDAO::getBookingDAO(self::$connection);
            $booking=$bookingDAO->consultByUser($cod,$type,$cod_user);
            return $booking;

        }
        
        /**
         * Crea un nuevo booki
         * @return void
         */
        public static function create($booking){
            $bookingDAO=bookingDAO::getBookingDAO(self::$connection);
            $bookingDAO->create($booking);

        }

           /**
         * Lista todos los bookistradores
         */
        public  static function listAll(){
            $bookingDAO = bookingDAO::getBookingDAO(self::$connection);
            $bookings=$bookingDAO->listAll();
            return $bookings;
        }
        public  static function listByDoc($doc,$type){
            $bookingDAO = bookingDAO::getBookingDAO(self::$connection);
            $bookings=$bookingDAO->listByDoc($doc,$type);
            return $bookings;
        }

        /**
         * Modifica un bookistrador
         * @return void
         */
        public static function modify($booking){
            $bookingDAO=bookingDAO::getBookingDAO(self::$connection);
            $bookingDAO->modify($booking);
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
