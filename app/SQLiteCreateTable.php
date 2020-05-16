<?php

namespace App;

/**
 * SQLite Create Table
 */
class SQLiteCreateTable {

    /**
     * PDO object
     * @var \PDO
     */
    private $pdo;

    /**
     * connect to the SQLite database
     * @param \PDO $pdo
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * create tables 
     */
    public function createTables() {
        $commands = ['CREATE TABLE IF NOT EXISTS subscribers (
                    id INTEGER PRIMARY KEY,
                    email  VARCHAR (50) NOT NULL,
                    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
                    )'];
        // execute the sql commands to create new tables
        foreach ($commands as $command) {
            $this->pdo->exec($command);
        }
    }
}