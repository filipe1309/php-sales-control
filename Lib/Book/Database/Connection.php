<?php
// 4 Persistence
// 4.3 Connections and Transactions
// 4.3.1 Class for connection with Factory Method
// 5 MVC Pattern
// 5.2 Namespace and directores organization


namespace Book\Database;

use PDO;
use Exception;


final class Connection {
    private function __construct() {}
    
    public static function open($name) {
                // verifica se existe arquivo de configuração para este banco de dados
        if (file_exists("App/Config/{$name}.ini"))
        {
            // lê o INI e retorna um array
            $db = parse_ini_file("App/Config/{$name}.ini");
        }
        else
        {
            // se não existir, lança um erro
            throw new Exception("Arquivo '$name' não encontrado");
        }
        
        // read file info
        $user = isset($db['user']) ? $db['user'] : NULL;
        $pass = isset($db['pass']) ? $db['pass'] : NULL;
        $name = isset($db['name']) ? $db['name'] : NULL;
        $host = isset($db['host']) ? $db['host'] : NULL;
        $type = isset($db['type']) ? $db['type'] : NULL;
        $port = isset($db['port']) ? $db['port'] : NULL;
        
        // set correct db driver
        
        switch ($type) {
            case 'pgsql':
                $port = $port ? $port : '5432';
                $conn = new PDO("pgsql:dbname={$name}; user={$user}; 
                    password={$pass}; host={$host}; port={$port}");
                break;
            
            case 'mysql':
                $port = $port ? $port : '3306';
                $conn = new PDO("mysql:dbname={$name}; host={$host}; 
                    port={$port}", $user, $pass);
                break;
            
            case 'sqlite':
                $conn = new PDO("sqlite:{$name}");
                break;
            
            case 'ibase':
                $conn = new PDO("firebird:dbname={$name}", $user, $pass);
                break;
            
            case 'oci8':
                $conn = new PDO("oci:dbname={$name}", $user, $pass);
                break;
            
            case 'mssql':
                $conn = new PDO("mssql:dbname={$name}; host={$host}", 
                    $user, $pass);
                break;
        }
        
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }
}