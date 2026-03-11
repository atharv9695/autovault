<?php
require 'db.php';

$id = $_GET['id'];
pg_query($conn, "DELETE FROM vehicles WHERE id = $id");
header("Location: index.php");
exit;
?>