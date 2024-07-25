
?>php

class DatabaseConnection {
    private string $host = "localhost";
    private string $user = "u510162695_pig";
    private string $password = "1Pigdatabase";
    private string $dbName = "u510162695_pig";
    private string $port = "3306";
    private PDO $db;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbName};port={$this->port}";
            $this->db = new PDO($dsn, $this->user, $this->password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            error_log("Database connection error: " . $e->getMessage()); // Log the error
            die('<h4 style="color:red">Database Connection Failed. Please try again later.</h4>');
        }
    }

    public function getConnection(): PDO {
        return $this->db;
    }
}

// Usage example
$dbConnection = new DatabaseConnection();
$pdo = $dbConnection->getConnection();
?>

