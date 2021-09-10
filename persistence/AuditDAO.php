<?php
/**
 * Archivo de conexión a la base de datos
 */
require_once('../persistence/util/Connection.php');

/**
 * Archivo de entidad
 */
require_once('../business/Audit.php');
/**
 * Interfaz DAO
 */
require_once('DAO.php');

/**
 * Dao para los users
 */
class AuditDAO implements DAO
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
	private static $auditDAO;


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
		$query="SELECT * FROM audit WHERE cod_audit=".$id;
		$rs = pg_query( $this->connection, $query );
		$audit = new Audit();
		if( $rs )
        {
             if( pg_num_rows($rs) > 0 )
            {
				$obj = pg_fetch_object($rs,0 );
				$audit->setCod_audit($obj->cod_audit);
				$audit->setCod_user($obj->cod_user);
				$audit->setAudit_date($obj->audit_date);
				$audit->setAction($obj->accion);
                $audit->setTable_affected($obj->table_affected);
                $audit->setCod_affected($obj->cod_affected);

			}
		}
		return $audit;
	}

	/**
	 * Crea una nuevo user en la base de datos
	 * @param  audit $newAudit
	 * @return void
	 */
	public function create($newAudit){

		$query="INSERT INTO audit(cod_user,audit_date,accion,table_affected,cod_affected) VALUES('".$newAudit->getCod_user()."','".$newAudit->getAudit_date()."','".$newAudit->getAction()."','".$newAudit->getTable_affected()."','".$newAudit->getCod_affected()."');";
		pg_query($this->connection, $query);

	}

	/**
	 * Modifica una user ingresado por parámetro
	 * @return void
	 */
	public function modify($audit){
		$query="UPDATE audit SET cod_user='".$audit->getCod_user()."', audit_date ='".$audit->getAudit_date()."', accion ='".$audit->getAction()."', table_affected='".$audit->getTable_affected()."', cod_affected='".$audit->getCod_affected()."' WHERE cod_audit= ".$audit->getCod_audit();
		pg_query($this->connection,$query);
	}

	/**
	 * Lista todos los objetos que se están en la tabla de user
	 * @return [audits]
	 */
	public function listAll(){
		$query="SELECT * FROM audit";
		$rs = pg_query( $this->connection, $query );
		$audits = array();
		if( $rs ){
			if( pg_num_rows($rs) > 0 ){
			   while( $obj = pg_fetch_object($rs) ){
					$audit=new Audit();
                    
                    $audit->setCod_audit($obj->cod_audit);
				    $audit->setCod_user($obj->cod_user);
				    $audit->setAudit_date($obj->audit_date);
				    $audit->setAction($obj->accion);
                    $audit->setTable_affected($obj->table_affected);
                    $audit->setCod_affected($obj->cod_affected);

					array_push($audits,$audit);
			   }
			}
		}
		return $audits;
	}

/*
	*Obtiene el objeto de esta clase
	*
	*@param $conexion
	*@return void
	*/
	public static function getAuditDAO($connection) {
            if(self::$auditDAO == null) {
                self::$auditDAO = new auditDAO($connection);
            }

            return self::$auditDAO;
        }

}


?>
