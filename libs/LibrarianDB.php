<?php
/**
 * @author Javier Luque Rodríguez
 */

/**
 * LibrarianDB
 */
class LibrarianDB
{
    private $server = 'localhost';
    private $db = 'librarian';
    private $user = 'luque';
    private $password = 'A.123123';

    private static ?LibrarianDB $instancia = null ;
    private static $conn = null ;
    
    /**
     * __clone
     *
     * @return void
     */
    private function __clone()
    {
    }
    
    /**
     * __construct
     *
     * @return void
     */
    private function __construct()
    {
        try {
            self::$conn = new PDO("mysql:host=".$this->server.";dbname=".$this->db.";charset=utf8", $this->user, $this->password);
        } catch (PDOException $e) {
            echo "Unable to connect to the database server.<br>";
            die("Error: " . $e->getMessage());
        }
    }

    /**
     * Connects to database
     *
     * @return LibrarianDB
     */
    public static function getConnection():LibrarianDB
    {
        if (self::$instancia==null) {
            self::$instancia = new LibrarianDB() ;
        }
        return self::$instancia ;
    }
    
    /**
     * SQL query
     *
     * @param  string $query
     * @return PDOStatement
     */
    public function query($query):PDOStatement
    {
        return self::$conn->query($query);
    }
    
    /**
     * Prepare a sql sentence and execute it with the given parameters
     *
     * @param  string $query
     * @return PDOStatement
     */
    public function prepare($query, $params = []):PDOStatement
    {
        $st = self::$conn->prepare($query);
        $st->execute($params);
        return $st;
    }

        
    /**
     * __destruct
     *
     * @return void
     */
    public function __destruct()
    {
        if (self::$conn != null) {
            self::$conn = null;
        }
    }
}
