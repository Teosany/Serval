<?php
class DataBase extends PDO
{
    const HOST = 'localhost';
    const USER = 'root';
    const PASSWORD = 'root';
    const DBNAME = 'fpview';

    public function __construct()
    {
        $dsn = "mysql:host=" . self::HOST . ";dbname=" . self::DBNAME;
        try {
            parent::__construct($dsn, self::USER, self::PASSWORD);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            echo "PDOException: " . $e->getMessage();
        }
    }
}