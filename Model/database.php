<?php

class Database {

    private static $dsn= "mysql:host=sql1.njit.edu;dbname=bsg23";
    private static $username = "bsg23";
    private static $project="bsg23";
    private static $password = "Faly0aJZJ";
    private static $conn;
    private function __construct() {}
    public static function database () {
        if (!isset(self::$conn)) {
            try {
                self::$conn = new PDO(self::$dsn,
                                     self::$username,
                                     self::$password);
            } 
            catch(PDOException $e){
				$error_message= $e->getMessage();
				include('db_error.php');
				exit();
            }
        }
        return self::$conn;
    }
}
?>
?>
