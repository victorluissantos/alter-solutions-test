<?php
namespace ASPTest\Model;

use ASPTest\Config\PDODb;

class DataMapper
{
    public static $db;

    public function __construct()
    {
        self::$db = new PDODb('mysql', 'root', 'rootpassword', 'myapp');
    }

    /**
     * @see Helper function to query database and return the full resultset.
     * @param $query: the SQL query string, can be either a straight query (without any external inputs) or a prepared statement using either named parameters (:param) or positional (?)
     * @param $param: the values, in array, to bind to a prepared statement, [value1, value2, ...] or ["name1" => value1, "name2" => value2, ...] for positional or named params
     * @return full resultset of the query
    */
    function queryDB(string $query, array $param=null) {
    
        global $dbh; //reference the db handle declared in init.php 
    
        if (isset($param)) { //query params provided, so a prepared statement
        
        $stmt = $dbh->prepare($query); //set up the prepared statement
    
        $isAssocArray = count(array_filter(array_keys($param), "is_string")) == 0 ? false : true; //boolean flag for associative array (dict, with keys) versus sequential array (list, without keys)  
        
        if ($isAssocArray) { //the prepared statement uses named parameters (:name1, :name2, ...)
            
            foreach($param as $name => $value) { //bind the parameters 1-by-1
            if (substr($name, 0, 1) != ":") { //if the provided parameter isn't prefixed with ':' which is required in bindParam()
                $name = ":".$name; //prefix it with ':'
            }
            $stmt->bindParam($name, $value);
            }
    
        } else { //the prepared statement uses unnamed parameters (?, ?, ...) 
            
            for($i = 1; $i <= count($param); $i++) { //bind the parameters 1-by-1
            $stmt->bindParam($i, $param[$i]); 
            }
    
        } //the prepared statement has its values bound and ready for execution
    
        $stmt->execute();
    
        } else { //not a prepared statement, a straight query
    
        $stmt = $dbh->query($query);   
    
        }
    
        $resultset = $stmt->fetchAll();
        return $resultset;
    
    }
}