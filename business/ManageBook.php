<?php

/**
 * Importe de clases
 */
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/Amazonia/persistence/util/Connection.php';
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/Amazonia/persistence/BookDAO.php';

class ManageBook
{

    /**
     * Atributo para la conexión a la base de datos
     */
    private static $connection;

    function __construct()
    {
    }

    /**
     * Obtiene un bookistrador
     * @param  [String] $book [Nombre de book del bookistrador a buscar]
     * @return [bookistrador] bookistrador encontrado
     */
    public static function consult($id)
    {

        $bookDAO = BookDAO::getBookDAO(self::$connection);
        $book = $bookDAO->consult($id);
        return $book;
    }
    /**
     * Obtiene un bookistrador
     * @param  [String] $book [Nombre de book del bookistrador a buscar]
     * @return [bookistrador] bookistrador encontrado
     */
    public static function consultByUser($id)
    {

        $bookDAO = BookDAO::getBookDAO(self::$connection);
        $book = $bookDAO->consultByUser($id);
        return $book;
    }

    /**
     * Crea un nuevo booki
     * @param book bookistrador a ingresar
     * @return void
     */
    public static function create($book)
    {
        $bookDAO = bookDAO::getBookDAO(self::$connection);
        $bookDAO->create($book);
    }

    /**
     * Lista todos los bookistradores
     * @return book[] Lista de todos los bookistradores de la base de datos
     */
    public  static function listAll()
    {
        $bookDAO = bookDAO::getBookDAO(self::$connection);
        $books = $bookDAO->listAll();
        return $books;
    }

    public  static function listByQuery($query){
        $bookDAO = bookDAO::getBookDAO(self::$connection);
        $books=$bookDAO->listByQuery($query);
        return $books;
    }

    public  static function lastInsert(){
        $bookingDAO = bookDAO::getBookDAO(self::$connection);
        $li=$bookingDAO->lastInsert();
        return $li;
    }
    /**
     * Modifica un bookistrador
     * @param book bookistrador a modificar
     * @return void
     */
    public static function modify($book)
    {
        $bookDAO = bookDAO::getBookDAO(self::$connection);
        $bookDAO->modify($book);
    }



    /**
     * Cambia la conexión
     */
    public static function setConnectionBD($connection)
    {
        self::$connection = $connection;
    }
}
