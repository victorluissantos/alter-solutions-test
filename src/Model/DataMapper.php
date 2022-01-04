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
}