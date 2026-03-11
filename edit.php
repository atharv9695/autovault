<?php
require 'db.php';

$id = $_GET['id'];
$vehicle = pg_fetch_assoc(pg_query($conn, "SELECT * FROM vehicles WHERE id = $id"));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $brand = $_POST['brand'];
    $year = $_POST['year'];
    $price = $_POST['price'];

    pg_query($conn, "UPDATE vehicles SET name='$name', type='$type', brand='$brand', year=$year, price=$price WHERE id=$id");
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Vehicle - AutoVault</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: 40px auto; padding: 0 20px; background: #f4f4f4; }
        h1 { color: #333; }
        form { background: white; padding: 30px; border-radius: 8px; }
        input, select { width: 100%; padding: 10px; margin: 8px 0 16px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        label { font-weight: bold; color: #555; }
        button { background: #3498db; color: white; padding: 12px 24px; border: none; border-radius: 6px; cursor: pointer; font-size: 16px; }
        a { color: #3498db; text-decoration: none; display: inline-block; margin-top: 15px; }
    </style>
</head>
<body>
    <h1>✏️ Edit Vehicle</h1>
    <form method="POST">
        <label>Vehicle Name</label>
        <input type="text" name="name" value="<?= $vehicle['name'] ?>" required>

        <label>Type</label>
        <select name="type">
            <option value="Car" <?= $vehicle['type']=='Car'?'selected':'' ?>>Car</option>
            <option value="Bike" <?= $vehicle['type']=='Bike'?'selected':'' ?>>Bike</option>
            <option value="Truck" <?= $vehicle['type']=='Truck'?'selected':'' ?>>Truck</option>
            <option value="SUV" <?= $vehicle['type']=='SUV'?'selected':'' ?>>SUV</option>
        </select>

        <label>Brand</label>
        <input type="text" name="brand" value="<?= $vehicle['brand'] ?>" required>

        <label>Year</label>
        <input type="number" name="year" value="<?= $vehicle['year'] ?>" required>

        <label>Price (₹)</label>
        <input type="number" name="price" value="<?= $vehicle['price'] ?>" step="0.01" required>

        <button type="submit">Update Vehicle</button>
    </form>
    <a href="index.php">← Back to list</a>
</body>
</html>