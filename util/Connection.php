<?php






class Connection{

    private static $conn;
    private static $server = '127.0.0.1';
    private static $banco = 'formPhp';
    private static $user = 'root';
    private static $passw = 'bancodedados';


    public static function getConn(){

        if(self::$conn == null){
            $opcoes = [PDO::MYSQL_ATTR_INIT_COMMAND => "set names utf8",
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];
            self::$conn = new PDO("mysql:host=".self::$server.";dbname=".self::$banco,
                                    self::$user,self::$passw,$opcoes);
        }
        
        return self::$conn;

    }

}
