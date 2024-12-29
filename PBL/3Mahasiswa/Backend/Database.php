<?php //class koneksi ke database
class Database {
    private $connection;

    public function __construct($serverName, $database) {
        $this->connection = $this->connectToDatabase($serverName, $database);
    }

    private function connectToDatabase($serverName, $database) {
        $connectionInfo = array("Database" => $database);
        $conn = sqlsrv_connect($serverName, $connectionInfo);
        if (!$conn) {
            die("Koneksi gagal: " . print_r(sqlsrv_errors(), true));
        }
        return $conn;
    }

    public function getConnection() {
        return $this->connection;
    }

    public function closeConnection() {
        sqlsrv_close($this->connection);
    }
}
?>