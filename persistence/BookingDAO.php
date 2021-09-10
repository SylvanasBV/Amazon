<?php
/**
 * Archivo de conexión a la base de datos
 */
require_once('../persistence/util/Connection.php');

/**
 * Archivo de entidad
 */
require_once('../business/Booking.php');
/**
 * Interfaz DAO
 */
require_once('DAO.php');

/**
 * Books DAO
 */
class BookingDAO implements DAO
{
	/**
	 * Conexión a la base de datos
	 * @var [Object]
	 */
	private $connection;

	/**
	 * Objeto de la clase bookDAO
	 * @var [bookingDAO]
	 */
	private static $bookingDAO;

	/**
	 * Constructor de la clase
	 */

	private function __construct($connection)
	{
		$this->connection=$connection;
	}

	/**
	 * Realiza la consulta de un objeto
	
	 */
	public function consult($cod_booking){
		$query="SELECT * FROM booking WHERE cod_booking=".$cod_booking;
		$rs = pg_query( $this->connection, $query );
		$booking = new Booking();
		if( $rs )
        {
             if( pg_num_rows($rs) > 0 )
            {
				$obj = pg_fetch_object($rs,0 );
				$booking->setCod_booking($obj->cod_booking);
				$booking->setCod_document($obj->cod_document);
				$booking->setType_document($obj->type_document);
				$booking->setAvailable($obj->available);
				$booking->setCod_user($obj->cod_user);
            }
            
		}
		return $booking;
	}

	public function consultByUser($cod,$type,$cod_user){
		$query="SELECT * FROM booking WHERE cod_document=".$cod." and type_document='".$type."' and available='Y' and cod_user=".$cod_user;
		$rs = pg_query( $this->connection, $query );
		$booking = new Booking();
		if( $rs )
        {
             if( pg_num_rows($rs) > 0 )
            {
				$obj = pg_fetch_object($rs,0 );
				$booking->setCod_booking($obj->cod_booking);
				$booking->setCod_document($obj->cod_document);
				$booking->setType_document($obj->type_document);
				$booking->setAvailable($obj->available);
				$booking->setCod_user($obj->cod_user);
            }
            
		}
		return $booking;
	}

	/**
	 * Crea una nuevo book en la base de datos
	 * @return void
	 */
	public function create ($newBooking){
		
		$query="INSERT INTO booking(cod_document,type_document,available,cod_user) VALUES('".$newBooking->getCod_document()."','".$newBooking->getType_document()."','".$newBooking->getAvailable()."','".$newBooking->getCod_user()."');";
		pg_query($this->connection, $query);

	}

	/**
	 * Modifica una book ingresado por parámetro
	 * @return void
	 */
	public function modify ($booking){

		$query="UPDATE booking SET cod_document='".$booking->getCod_document()."', type_document ='".$booking->getType_document()."', available ='".$booking->getAvailable()."', cod_user='".$booking->getCod_user()."' where cod_booking=".$booking->getCod_booking().";";
		pg_query($this->connection,$query);
	}

	/**
	 * Lista todos los objetos que se están en la tabla de book
	 */
	public function listAll(){
		$query="SELECT * FROM booking";
		$rs = pg_query( $this->connection, $query );
		$bookings = array();
		if( $rs ){
			if( pg_num_rows($rs) > 0 ){
			   while( $obj = pg_fetch_object($rs) ){
					$booking=new booking();
			                    
					$booking->setCod_booking($obj->cod_booking);
				    $booking->setCod_document($obj->cod_document);
				    $booking->setType_document($obj->type_document);
				    $booking->setAvailable($obj->available);
				    $booking->setCod_user($obj->cod_user);
					
					array_push($bookings,$booking);
			   }
			}
		}
		return $bookings;
	}

	public function listByDoc($doc,$type){
		$query="SELECT * FROM booking where cod_document=".$doc." and type_document='".$type."' and available='Y'";
		$rs = pg_query( $this->connection, $query );
		$bookings = array();
		if( $rs ){
			if( pg_num_rows($rs) > 0 ){
			   while( $obj = pg_fetch_object($rs) ){
					$booking=new booking();
			                    
					$booking->setCod_booking($obj->cod_booking);
				    $booking->setCod_document($obj->cod_document);
				    $booking->setType_document($obj->type_document);
				    $booking->setAvailable($obj->available);
				    $booking->setCod_user($obj->cod_user);
					
					array_push($bookings,$booking);
			   }
			}
		}
		return $bookings;
	}

	/*
	*Obtiene el objeto de esta clase
	*/
	public static function getBookingDAO($connection) {
            if(self::$bookingDAO == null) {
                self::$bookingDAO = new bookingDAO($connection);
            }

            return self::$bookingDAO;
    }

}
