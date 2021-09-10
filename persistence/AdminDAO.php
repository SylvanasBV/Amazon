<?php
/**
 * Archivo de conexión a la base de datos
 */
require_once('../persistence/util/Connection.php');

/**
 * Archivo de entidad
 */
require_once('../business/Administrator.php');
/**
 * Interfaz DAO
 */
require_once('DAO.php');

/**
 * Dao para los admins
 */
class AdminDAO implements DAO
{
	/**
	 * Conexión a la base de datos
	 * @var [Object]
	 */
	private $connection;

	/**
	 * Objeto de la clase adminDAO
	 * @var [adminDAO]
	 */
	private static $adminDAO;


	/**
	 * Constructor de la clase
	 */

	private function __construct($connection)
	{
		$this->connection=$connection;
	}

	/**
	 * Realiza la consulta de un objeto
	 * @param  [int] $codigo [Código del objeto a consultar]
	 * @return [admin]         admin encontrado
	 */
	public function consult($id){
		$query="SELECT * FROM administrator WHERE cod_admin=".$id;
		$rs = pg_query( $this->connection, $query );
		$admin = new Administrator();
        if( $rs )
        {
             if( pg_num_rows($rs) > 0 )
            {
				$obj = pg_fetch_object($rs,0 );
				$admin->setId($obj->cod_admin);
				$admin->setPassword($obj->pass_admin);
				$admin->setEmail($obj->email_admin);
				$admin->setName($obj->name_admin);
            }
            
		}
		return $admin;
	}

	/**
	 * Realiza la consulta de un objeto
	 * @param  [int] $codigo [Código del objeto a consultar]
	 * @return [admin]         admin encontrado
	 */
	public function consultByMail($email){
		$query="SELECT * FROM administrator WHERE email_admin='".$email."'";
		$rs = pg_query( $this->connection, $query );
		$admin = new Administrator();
        if( $rs )
        {
             if( pg_num_rows($rs) > 0 )
            {
				$obj = pg_fetch_object($rs,0 );
				$admin->setId($obj->cod_admin);
				$admin->setPassword($obj->pass_admin);
				$admin->setEmail($obj->email_admin);
				$admin->setName($obj->name_admin);
            }
            
		}
		return $admin;
	}
	/**
	 * Crea una nuevo admin en la base de datos
	 * @param  admin $newUser
	 * @return void
	 */
	public function create ($newUser){
		$password = password_hash($newUser->getPassword(), PASSWORD_BCRYPT);

		$query="INSERT INTO administrator(name_admin,email_admin,pass_admin) VALUES('".$newUser->getName()."','".$password."','".$newUser->getEmail()."');";
		pg_query($this->connection, $query);

	}

	/**
	 * Modifica una admin ingresado por parámetro
	 * @param  admin $admin admin ingresado por parámetro
	 * @return void
	 */
	public function modify ($admin){
		$password = password_hash($admin->getPassword(), PASSWORD_BCRYPT);
		$query="UPDATE administrator SET name_admin='".$admin->getName()."', email_admin ='".$admin->getEmail()."', pass_admin='".$password."' WHERE cod_admin= ".$admin->getId();
		pg_query($this->connection,$query);
	}

	/**
	 * Lista todos los objetos que se están en la tabla de admin
	 * @return [admins]
	 */
	public function listAll(){
		$query="SELECT * FROM admin";
		$rs = pg_query( $this->connection, $query );
		if( $rs ){
             if( pg_num_rows($rs) > 0 ){
				while( $obj = pg_fetch_object($rs) ){
					$admin=new Administrator();

					$admin->setId($obj->cod_admin);
					$admin->setPassword($obj->pass_admin);
					$admin->setEmail($obj->email_admin);
					$admin->setName($obj->name_admin);
					
					array_push($admins,$admin);
				}
            }
            
		}
		return $admins;
	}

	/*
	*Obtiene el objeto de esta clase
	*
	*@param $conexion
	*@return void
	*/
	public static function getAdminDAO($connection) {
            if(self::$adminDAO == null) {
                self::$adminDAO = new AdminDAO($connection);
            }

            return self::$adminDAO;
        }

}


?>
