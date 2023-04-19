<?php

namespace Src\App\Producer;

use PDO;

/**
 * Class SendMailJob
 *
 * @author <jonas-elias/>
 */
class ProducerMail
{
    public function handle($params)
    {
        $host = $_ENV['MYSQL_HOST'];
        $dbname = $_ENV['MYSQL_DATABASE'];
        $username = $_ENV['MYSQL_USER'];
        $password = $_ENV['MYSQL_PASSWORD'];

        $dsn = "mysql:host=$host;dbname=$dbname";
        $pdo = new PDO($dsn, $username, $password);

        $nomeQueue = __CLASS__;
        $namespace = 'Src\App\Jobs\SendMailJob';
        $values = json_encode($params);
        $sql = "INSERT INTO " . $dbname . ".queue(nome_queue, namespace, payload) values ('$nomeQueue', '" . addslashes($namespace) . "', '$values')";

        $pdo->query($sql);
    }
}
