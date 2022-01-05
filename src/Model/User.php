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
        return self::$db->fetch("SELECT * FROM `$this->table` WHERE `id` = ?",array($id));
    }

    /**
     * @see Get the User from Email
     * @param [INT] $email, Email from table
     * @return [Array] $user
     */
    public function getByEmail($email)
    {
        return self::$db->fetchAll("SELECT id FROM `$this->table` WHERE `email` = :email", array($email));
    }

    /**
     * @see Update the password colum
     * @param [String] $id
     * @param [String] $passwd
     */
    public function setPWD($passwd, $id)
    {
        $options = [
           'cost' => 10
        ];

        $hashed_passwd = password_hash($passwd, PASSWORD_BCRYPT, $options);
        
        return self::$db->update("UPDATE `$this->table` SET `password` = :pass WHERE `id` = :id;", array($hashed_passwd, $id));
    }
}