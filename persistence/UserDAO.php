<?php
/**
 * Archivo de conexión a la base de datos
 */
require_once('../persistence/util/Connection.php');

/**
 * Archivo de entidad
 */
require_once('../business/User.php');
/**
 * Interfaz DAO
 */
require_once('DAO.php');

/**
 * Dao para los users
 */
class UserDAO implements DAO
{
	/**
	 * Conexión a la base de datos
	 * @var [Object]
	 */
	private $connection;

	/**
	 * Objeto de la clase userDAO
	 * @var [userDAO]
	 */
	private static $userDAO;


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
	 * @return [user]         user encontrado
	 */
	public function consult($id){
		$query="SELECT * FROM usr WHERE cod_user=".$id;
		$rs = pg_query( $this->connection, $query );
		$user = new User();
		if( $rs )
        {
             if( pg_num_rows($rs) > 0 )
            {
				$obj = pg_fetch_object($rs,0 );
				$user->setId($obj->cod_user);
				$user->setPassword($obj->pass_user);
				$user->setEmail($obj->email_user);
				$user->setStatus($obj->status_user);
				$user->setName($obj->name_user);
			}
		}
		return $user;
	}

	/**
	 * Realiza la consulta de un objeto
	 * @param  [int] $codigo [Código del objeto a consultar]
	 * @return [user]         user encontrado
	 */
	public function consultByMail($email){
		$query="SELECT * FROM usr WHERE email_user='".$email."'";
		$rs = pg_query( $this->connection, $query );
		$user = new User();
		if( $rs )
        {
             if( pg_num_rows($rs) > 0 )
            {
				$obj = pg_fetch_object($rs,0 );
				$user->setId($obj->cod_user);
				$user->setPassword($obj->pass_user);
				$user->setEmail($obj->email_user);
				$user->setStatus($obj->status_user);
				$user->setName($obj->name_user);
			}
		}
		return $user;

	}
	/**
	 * Crea una nuevo user en la base de datos
	 * @param  user $newUser
	 * @return void
	 */
	public function create ($newUser){
		$password = password_hash($newUser->getPassword(), PASSWORD_BCRYPT);

		$query="INSERT INTO usr(name_user,pass_user,status_user,email_user) VALUES('".$newUser->getName()."','".$password."','".$newUser->getStatus()."','".$newUser->getEmail()."');";
		pg_query($this->connection, $query);

	}

	/**
	 * Modifica una user ingresado por parámetro
	 * @param  user $user user ingresado por parámetro
	 * @return void
	 */
	public function modify ($user){
		$query="UPDATE usr SET name_user='".$user->getName()."', email_user ='".$user->getEmail()."', status_user='".$user->getStatus()."' WHERE cod_user= ".$user->getId();
		pg_query($this->connection,$query);
	}

	/**
	 * Lista todos los objetos que se están en la tabla de user
	 * @return [users]
	 */
	public function listAll(){
		$query="SELECT * FROM usr";
		$rs = pg_query( $this->connection, $query );
		$users = array();
		if( $rs ){
			if( pg_num_rows($rs) > 0 ){
			   while( $obj = pg_fetch_object($rs) ){
					$user=new user();

					$user->setId($obj->cod_user);
					$user->setName($obj->name_user);
					$user->setEmail($obj->email_user);
					$user->setPassword($obj->pass_user);
					$user->setStatus($obj->status_user);

					array_push($users,$user);
			   }
			}
		}
		return $users;
	}

/*
	*Obtiene el objeto de esta clase
	*
	*@param $conexion
	*@return void
	*/
	public static function getUserDAO($connection) {
            if(self::$userDAO == null) {
                self::$userDAO = new userDAO($connection);
            }

            return self::$userDAO;
        }

}


?>
