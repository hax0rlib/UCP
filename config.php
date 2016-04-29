<?php
class DB
{
    private $pdo = null;
    private $dsn = null;
    public function __construct()
    {
        $this->pdo = $pdo;
        $this->dsn = $dsn;
    }
    private function getConnection()
    {
        $this->dsn = "mysql:host=localhost;dbname=rpg";
        $this->pdo = new PDO($this->dsn, $user, $pass);
    }
}
?>
