<?php
$host = "autovault-db.postgres.database.azure.com";
$dbname = "postgres";
$user = "autovaultadmin";
$password = "Atharvkawade@9695";
$port = "5432";

$conn = pg_connect("host=$host dbname=$dbname user=$user password=$password port=$port sslmode=require");

if (!$conn) {
    die("Connection failed: " . pg_last_error());
}
?>