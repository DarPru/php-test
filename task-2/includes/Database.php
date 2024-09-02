<?php

class Database
{
    private $pdo;

    public function __construct($host, $db, $user, $pass)
    {
        $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->pdo = new PDO($dsn, $user, $pass, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function insertData($data)
    {
        $sql = "INSERT INTO todos (userId, id, title, completed) VALUES (:userId, :id, :title, :completed)";
        $stmt = $this->pdo->prepare($sql);

        foreach ($data as $item) {
            $stmt->execute([
                ':userId'   => $item['userId'],
                ':id'       => $item['id'],
                ':title'    => $item['title'],
                ':completed'=> $item['completed'],
            ]);
        }
    }
}
