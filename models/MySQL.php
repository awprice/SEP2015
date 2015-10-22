<?php

class MySQL {

    private $pdo;

    /**
     * Initialise the PDO MySQL connection
     */
    function __construct() {
        if ($GLOBALS['mysql_sqlite']) {
            $connection = 'sqlite:' . $GLOBALS['mysql_host'];
            $this->pdo = new PDO($connection);
        } else {
            $this->pdo = new PDO('mysql:host=' . $GLOBALS['mysql_host'] . ';dbname=' . $GLOBALS['mysql_database'], $GLOBALS['mysql_user'], $GLOBALS['mysql_pass']);
        }
    }

    /**
     * Executes an sql query
     *
     * @param $query
     * @param $data
     * @return bool
     */
    function query($query, $data) {
        $statement = $this->pdo->prepare($query);
        if ($statement === false) {
            return ['success' => false, 'results' => []];
        }
        $result = $statement->execute($data);
        if ($result === false) {
            return ['success' => false, 'results' => []];
        }
        return ['success' => true, 'results' => $statement->fetchAll(PDO::FETCH_ASSOC)];
    }

}

?>