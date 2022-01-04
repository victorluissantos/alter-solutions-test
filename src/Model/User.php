<?php
namespace ASPTest\Model;

use ASPTest\Model\DataMapper;

/**
 * @see MAPPER to Object User
 * @author Santos L. Victor
 */
class User extends DataMapper
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'users';
    }

    public function insert($row)
    {
        // return "INSERT INTO `$this->table` (`".implode("', '", array_keys($row))."`) VALUES (?,?,?,?)";
        // return $row;
        $sql = "INSERT INTO `$this->table` (`".implode("', '", array_keys($row))."`) VALUES (?,?,?)";
        return $sql;
        return self::$db->insert($sql, $row);
    
    }

    public function setPWD($key, $pass)
    {
        self::$db->update("UPDATE `$this->table` SET `password` = '$pass' WHERE `id` = ?", array($pass, $key));
    }
}