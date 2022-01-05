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
        return self::$db->insert("INSERT INTO `$this->table` (`".implode("`, `", array_keys($row))."`) VALUES (:".implode(", :", array_keys($row)).")", array_values($row));
    }

    /**
     * @see Get the User from ID (pk)
     * @param [INT] $id, PK from table
     * @return [Array] $user
     */
    public function getByID($id)
    {
        return self::$db->fetchAll("SELECT id FROM users WHERE `id` = '1' limit 1;");//, array($id));
    }

    /**
     * @see Get the User from Email
     * @param [INT] $email, Email from table
     * @return [Array] $user
     */
    public function getByEmail($email)
    {
        return self::$db->fetchAll("SELECT id FROM `$this->table` WHERE `email` = ?", array($email));
    }

    public function setPWD($key, $pass)
    {
        self::$db->update("UPDATE `$this->table` SET `password` = '$pass' WHERE `id` = ?", array($pass, $key));
    }
}