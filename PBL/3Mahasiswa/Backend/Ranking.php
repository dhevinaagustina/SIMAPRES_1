<?php
//class untuk pengambilan data ranking
require 'Database.php';
class Ranking {
    private $db;

    public function __construct($serverName, $database) {
        $this->db = new Database($serverName, $database);
    }

    public function getRanking() {
        $conn = $this->db->getConnection();
        $sql = "{CALL GetMahasiswaRanking}";
        $stmt = sqlsrv_query($conn, $sql);

        if ($stmt === false) {
            die("Kesalahan dalam memanggil stored procedure: " . print_r(sqlsrv_errors(), true));
        }

        $results = [];
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $results[] = $row;
        }

        sqlsrv_free_stmt($stmt);
        $this->db->closeConnection();

        return $results;
    }
}
?>