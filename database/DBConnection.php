<?php

namespace Database;

use PDO;

class DBConnection
{
    private $_dbName = 'coffeeapp';
    private $_dbHost = 'localhost';
    private $_dbUser = 'root';
    private $_dbPass = '';
    private $pdo;

  /*   public function __construct(string $dbName, string $dbHost, string $dbUser, string $dbPass)
    {
        $this->_dbName = $dbName;
        $this->_dbHost = $dbHost;
        $this->_dbUser = $dbUser;
        $this->_dbPass = $dbPass;
    } */

    public function getPDO(): PDO
    {
        return $this->pdo ?? $this->pdo = new PDO("mysql:host=$this->_dbHost;dbname=$this->_dbName;charset=utf8", "$this->_dbUser", "$this->_dbPass", [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ]);
    }
}