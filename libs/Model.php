<?php

class Model {

    function __construct() {
        //Database connection object
        $this->db = new Database(_DBTYPE_, _DBHOST_, _DBNAME_, _DBUSERNAME_, _DBPASSWORD_);
      //Insert in a table
    }

    /**
     * getFieldFromAnyElse - Find a field value from another in the same table
     * @param string $tableName : the table that contain the field we want to get
     * @param string $theField : the field we want to get
     * @param string $anyElseFieldName : the other field we have name
     * @param string $anyElseFieldValue : the other field we have value
     *
     * @return string The value from database of the wanted field
     */

    public static function getFieldFromAnyElse($tableName, $theField, $anyElseFieldName, $anyElseFieldValue){

    	//Read data on the database
    	$searchQuery = "SELECT ".$theField;
    	$searchQuery .= " FROM ".$tableName;
    	$searchQuery .= " WHERE " . $anyElseFieldName;
    	$searchQuery .= " = ? ";
		//Prepare the query and Fetch the value
    	$preparedQuery = (new Model)->db->prepare($searchQuery);
    	$preparedQuery->execute(array($anyElseFieldValue));
    	$resultSet = $preparedQuery->fetch();
    	//returning the value
      //Echoing this for
      //debugging purpose
      //var_dump($resultSet);

      if($resultSet!=false){
        return $resultSet[$theField];
      }else{
        return $field = "Aucun resultat pour ce mot clé!";
      }


    }

    /**
     * doesKeyExist - Check if a key exists (id and so on)
     * @param string $tableName : the table that contain the key we want to check
     * @param string $field : the field we want to check name
     * @param string $keyValue : the key value
     *
     * @return $itemExists boolean true if the key doesn't exist and the count of the fields found with that key
     */

	public static function doesKeyExist($tableName, $field, $keyValue) {

    $searchQuery = "SELECT *";
    $searchQuery .= " FROM " . $tableName;
    $searchQuery .= " WHERE " . $field . "=?";

    $count = 0;
    $preparedQuery = (new Model)->db->prepare($searchQuery);
    $preparedQuery->execute(array($keyValue));
    $count = $preparedQuery->rowCount();
    $preparedQuery->closeCursor();

    $itemExists =  ($count > 0) ? true : false;

    return $itemExists;
	}

	/**
     * listItemFromDbTable - list given item
     * @param string $tableName : the table that contain the items we wanna list
     * @param string $field : the item we want to list
     *
     * @return array list of the items
     */

	public static function listItemFromDbTable($tableName, $field){

		//Read data on the database
    	$searchQuery = "SELECT ".$field;
    	$searchQuery .= " FROM ".$tableName;
    	$searchQuery .= " WHERE ? ORDER BY ".$field." ASC" ;

		//Prepare the query and Fetch the values
    	$preparedQuery = (new Model)->db->prepare($searchQuery);
    	$preparedQuery->execute(array(1));
    	//$resultSet = $preparedQuery->fetchAll();
    	//returning the array of values

    	//Item lists
    	$itemList = [];

    	while($resultSet=$preparedQuery->fetch(PDO::FETCH_ASSOC)){
		array_push($itemList, $resultSet[$field]);
		}
		return $itemList;
	}

}
