<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$host = "autovault-db.postgres.database.azure.com";
$dbname = "postgres";
$user = "autovaultadmin";
$password = "Atharvkawade@9695";
$port = "5432";

$conn = pg_connect("host=$host dbname=$dbname user=$user password=$password port=$port sslmode=require");

if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

// Azure Blob Storage
define('AZURE_STORAGE_ACCOUNT', 'studentsstorage123');
define('AZURE_STORAGE_KEY', 'tAPMvpDq7SecA0cLSEDX+D0UW/uLNeNvKHTZ1iZLNmHn0BctFAkny3PqJuzp+prQXHd7uaqtq+ru+AStjxo6Ig==');
define('AZURE_CONTAINER', 'vehicle-images');
?>