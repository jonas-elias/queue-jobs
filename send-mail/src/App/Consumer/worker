<?php

require_once __DIR__ . "./../Jobs/SendMailJob.php";
require_once __DIR__ . "./../Classes/AttributesMailClass.php";
require_once __DIR__ . "./../Classes/SendMailClass.php";
require_once __DIR__ . "./../../Config/MailConfig.php";
require_once __DIR__ . "./../../../vendor/phpmailer/phpmailer/src/PHPMailer.php";
require_once __DIR__ . "./../../../vendor/phpmailer/phpmailer/src/SMTP.php";

$host = $_ENV['MYSQL_HOST'];
$dbname = $_ENV['MYSQL_DATABASE'];
$username = $_ENV['MYSQL_USER'];
$password = $_ENV['MYSQL_PASSWORD'];

$dsn = "mysql:host=$host;dbname=$dbname";
$pdo = new PDO($dsn, $username, $password);

while(true) {
    $sql = "SELECT * FROM my_database.queue ORDER BY id ASC;";

    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($results as $key => $value) {
        (new $value['namespace']())->handle((array)json_decode(($value['payload'])));
    }

    if ($results[0])
    echo "Aguardando...\n";
    sleep(1);
}
