<?php

namespace App;

/**
 * PHP SQLite Insert methods
 */
class SQLiteSubscribers {

    /**
     * PDO object
     * @var \PDO
     */
    private $pdo;

    /**
     * Initialize the object with a specified PDO object
     * @param \PDO $pdo
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }


    /**
     * Insert a new record into the subscribers table
     */
    public function insertSubscriber($email) {
        $sql = 'INSERT INTO subscribers(email) VALUES(:email)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':email' => $email,
        ]);
        return $this->pdo->lastInsertId();
    }


    /**
     * Check if an email exists among subscribers
     */
     public function subscriberExists($email) {
        $sql = 'SELECT 1 FROM subscribers WHERE email=:email;';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $row = $stmt->fetch(\PDO::FETCH_ASSOC);
    }


    /**
     * Returns array of subscriber records
     */
     public function getSubscriberRecords() {
        if($stmt = $this->pdo->query("SELECT * FROM subscribers;")){
            $subscribers = [];
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $subscribers[] = $row;
            }
            return $subscribers;
        }else{
            return 'unset';
        }
    }


    /**
     * Returns array of email addresses
     */
     public function getSubscriberEmails() {
        $stmt = $this->pdo->query("SELECT email
                                   FROM subscribers
                                   ");
        $subscribers = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $subscribers[] = $row['email'];
        }
        return $subscribers;
    }
}