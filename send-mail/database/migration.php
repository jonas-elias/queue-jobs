<?php

$host = $_ENV['MYSQL_HOST'];
$dbname = $_ENV['MYSQL_DATABASE'];
$username = $_ENV['MYSQL_USER'];
$password = $_ENV['MYSQL_PASSWORD'];

$dsn = "mysql:host=$host;dbname=$dbname";
$pdo = new PDO($dsn, $username, $password);

$sql = "CREATE TABLE my_database.queue (
    id INT NOT NULL AUTO_INCREMENT,
    nome_queue VARCHAR(255) NOT NULL,
    namespace VARCHAR(255) NOT NULL,
    payload VARCHAR(255) NOT NULL,
    status TINYINT(1) NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
  );";

$pdo->exec($sql);
