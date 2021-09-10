<?php

/**
 * Interfaz: Uso de patron singleton para los DAO
 */
interface DAO{

/** 
 * Realiza la consulta de un elemento específico a partir de su código 
 * @param  [int] $codigo [código del object a buscar]
 * @return [object]         [object encontrado]
 */
public function consult ($codigo);

/**
 * Crea un nuevo object 
 * @param  [object] $object [Nuevo object]
 * @return [void]         
 */
public function create ($object);


/**
 * Modifica el object ingresado por parámetro
 * @param  [object] $object 
 * @return [void]
 */
public function modify($object);

/**
 * Lista todos los elementos de la tabla consultada
 * @return [object[]] 
 */
public function listAll();


}


?>