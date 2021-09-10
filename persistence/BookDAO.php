<?php

/**
 * Archivo de conexión a la base de datos
 */
require_once('../persistence/util/Connection.php');

/**
 * Archivo de entidad
 */
require_once('../business/Book.php');
/**
 * Interfaz DAO
 */
require_once('DAO.php');

/**
 * Books DAO
 */
class BookDAO implements DAO
{
	/**
	 * Conexión a la base de datos
	 * @var [Object]
	 */
	private $connection;

	/**
	 * Objeto de la clase bookDAO
	 * @var [bookDAO]
	 */
	private static $bookDAO;

	/**
	 * Constructor de la clase
	 */

	private function __construct($connection)
	{
		$this->connection = $connection;
	}

	/**
	 * Realiza la consulta de un objeto
	 * @param  [int] $codigo [Código del objeto a consultar]
	 * @return [book] book encontrado
	 */
	public function consult($id)
	{
		$query = "SELECT * FROM book WHERE id_book=" . $id;
		$rs = pg_query($this->connection, $query);
		$book = new Book();
		if ($rs) {
			if (pg_num_rows($rs) > 0) {
				$obj = pg_fetch_object($rs, 0);
				$book->setId($obj->id_book);
				$book->setTitle($obj->title);
				$book->setIsbn($obj->isbn);
				$book->setDatePublished($obj->datepublished);
				$book->setEditorial($obj->editorial);
				$book->setAvailable($obj->available);
				$book->setUrl($obj->url);
				$book->setAuthors($obj->authors);
				$book->setDescription($obj->description);
				$book->setIdUser($obj->cod_user);
				$book->setNumPages($obj->num_pages);
				$book->setQuantity($obj->quantity);

			}
		}
		return $book;
	}

	/**
	 * Realiza la consulta de un objeto
	 * @param  [int] $codigo [Código del objeto a consultar]
	 * @return [book] book encontrado
	 */
	public function consultByUser($id)
	{
		$query = "SELECT * FROM book WHERE cod_user=" . $id;
		$rs = pg_query($this->connection, $query);
		$book = new Book();
		$books = array();
		if ($rs) {
			if (pg_num_rows($rs) > 0) {
				while ($obj = pg_fetch_object($rs)) {
					$book = new book();
					$book->setId($obj->id_book);
					$book->setTitle($obj->title);
					$book->setIsbn($obj->isbn);
					$book->setDatePublished($obj->datepublished);
					$book->setEditorial($obj->editorial);
					$book->setAvailable($obj->available);
					$book->setUrl($obj->url);
					$book->setAuthors($obj->authors);
					$book->setDescription($obj->description);
					$book->setIdUser($obj->cod_user);
					$book->setNumPages($obj->num_pages);
					$book->setQuantity($obj->quantity);

					array_push($books, $book);
				}
			}
		}
		return $books;
	}


	/**
	 * Crea una nuevo book en la base de datos
	 * @param  book $newBook
	 * @return void
	 */
	public function create($newBook)
	{

		$query = "INSERT INTO book(title,isbn,datepublished,editorial,available,url,authors,description,cod_user,num_pages,quantity) VALUES('" . $newBook->getTitle() . "','" . $newBook->getISBN() . "','" . $newBook->getDatePublished() . "','" . $newBook->getEditorial() . "','" . $newBook->getAvailable() . "','" . $newBook->getUrl() . "','" . $newBook->getAuthors() . "','" . $newBook->getDescription() . "','" . $newBook->getIdUser() . "','" . $newBook->getNumPages() . "',".$newBook->getQuantity().");";
		pg_query($this->connection, $query);
	}

	/**
	 * Modifica una book ingresado por parámetro
	 * @param  book $book book ingresado por parámetro
	 * @return void
	 */
	public function modify($book)
	{

		$query = "UPDATE book SET title='" . $book->getTitle() . "', isbn ='" . $book->getIsbn() . "', datePublished='" . $book->getDatePublished() . "', editorial='" . $book->getEditorial() . "', available='" . $book->getAvailable() . "', url='" . $book->getUrl() . "', authors='" . $book->getAuthors() . "', description='" . $book->getDescription() . "', num_pages='" . $book->getNumPages() . "', quantity=".$book->getQuantity()." WHERE id_book= " . $book->getId();
		pg_query($this->connection, $query);
	}

	/**
	 * Lista todos los objetos que se están en la tabla de book
	 * @return [books]
	 */
	public function listAll()
	{
		$query = "SELECT * FROM book";
		$rs = pg_query($this->connection, $query);
		$books = array();
		if ($rs) {
			if (pg_num_rows($rs) > 0) {
				while ($obj = pg_fetch_object($rs)) {
					$book = new book();
					$book->setId($obj->id_book);
					$book->setTitle($obj->title);
					$book->setIsbn($obj->isbn);
					$book->setDatePublished($obj->datepublished);
					$book->setEditorial($obj->editorial);
					$book->setAvailable($obj->available);
					$book->setUrl($obj->url);
					$book->setAuthors($obj->authors);
					$book->setDescription($obj->description);
					$book->setIdUser($obj->cod_user);
					$book->setNumPages($obj->num_pages);
					$book->setQuantity($obj->quantity);

					array_push($books, $book);
				}
			}
		}
		return $books;
	}

	public function listByQuery($query){
		$query="SELECT * FROM book where title ILIKE '%".$query."%' or isbn ILIKE '%".$query."%' or editorial ILIKE '%".$query."%' or authors ILIKE '%".$query."%'";
		$rs = pg_query( $this->connection, $query );
		$books = array();
		if( $rs ){
			if( pg_num_rows($rs) > 0 ){
			   while( $obj = pg_fetch_object($rs) ){
					$book=new book();
					$book->setId($obj->id_book);
					$book->setTitle($obj->title);
					$book->setIsbn($obj->isbn);
					$book->setDatePublished($obj->datepublished);
					$book->setEditorial($obj->editorial);
					$book->setAvailable($obj->available);
					$book->setUrl($obj->url);
					$book->setAuthors($obj->authors);
					$book->setDescription($obj->description);
					$book->setIdUser($obj->cod_user);
					$book->setNumPages($obj->num_pages);
					$book->setQuantity($obj->quantity);
					
					array_push($books,$book);
			   }
			}
		}
		return $books;
	}

	public function lastInsert(){
		$query="SELECT id_book from book order by id_book DESC limit 1";
		$rs = pg_query( $this->connection, $query );
		if( $rs ){
			if( pg_num_rows($rs) > 0 ){
				$obj = pg_fetch_object($rs, 0);
				$id=$obj->id_book;
			}
		}
		return $id;
	}
	/*
	*Obtiene el objeto de esta clase
	*
	*@param $conexion
	*@return void
	*/
	public static function getBookDAO($connection)
	{
		if (self::$bookDAO == null) {
			self::$bookDAO = new bookDAO($connection);
		}

		return self::$bookDAO;
	}
}
