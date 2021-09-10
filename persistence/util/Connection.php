<?php
	/**
	 * Clase que realiza la conexión a la base de datos
	 */
	class Connection {

		/**
		 * Conecta con la base de datos
		 * @return Object $connection Devuelve un objeto para conectar con la base de datos en caso de éxito y false en caso de error
		 */
		public function conectBD(){
			$conexion = pg_connect( "user= user ".
                                "password=123 ".
                                "host=35.224.19.30 ".
                                "dbname=postgres"
                               ) or die( "Error al conectar: ".pg_last_error() );
        	return $conexion;
		}

		/**
		 * Cierra la conexión a la base de datos
		 * @param  Object $connection Conexión a la base de datos
		 * @return boolean $cerrar Devuelve true en caso de éxito y false en caso de error
		 */
		public function turnOffBD($connection){

			$close = pg_close($connection);
			return $close;
		}
	}
	?>
