<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

function getDbConnection(): mysqli
{
    static $connection = null;

    if ($connection === null) {
        $host = getenv('DB_HOST') ?: 'db';
        $port = (int) (getenv('DB_PORT') ?: 3306);
        $username = getenv('DB_USERNAME') ?: 'root';
        $password = getenv('DB_PASSWORD') ?: 'supergeheim';
        $database = getenv('DB_NAME') ?: 'phples';

        $connection = new mysqli($host, $username, $password, $database, $port);

        if ($connection->connect_error) {
            throw new RuntimeException('Databaseverbinding mislukt: ' . $connection->connect_error);
        }
    }

    return $connection;
}

$pdo = getDbConnection();
?>
