<?php

class Database
{
    private $serverName;
    private $userName;
    private $password;
    private $dbName;
    protected $con;
    public function __construct()
    {
        $this->serverName = serverName;
        $this->userName = userName;
        $this->password = password;
        $this->dbName = dbName;
        $this->con = mysqli_connect($this->serverName, $this->userName, $this->password, $this->dbName);
        if (!$this->con) {
            die("Connection failed: " . mysqli_connect_error($this->con));
        }
    }
}
