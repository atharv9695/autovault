<?php
require 'db.php';

$result = pg_query($conn, "CREATE TABLE IF NOT EXISTS vehicles (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100),
    type VARCHAR(50),
    brand VARCHAR(50),
    year INT,
    price DECIMAL(10,2)
)");

$vehicles = pg_query($conn, "SELECT * FROM vehicles ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>AutoVault 🚗</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 1000px; margin: 40px auto; padding: 0 20px; background: #f4f4f4; }
        h1 { color: #333; }
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; }
        th { background: #2c3e50; color: white; padding: 12px; }
        td { padding: 10px; border-bottom: 1px solid #ddd; text-align: center; }
        tr:hover { background: #f0f0f0; }
        a.btn { padding: 6px 12px; border-radius: 4px; text-decoration: none; color: white; }
        .edit { background: #3498db; }
        .delete { background: #e74c3c; }
        .add { background: #2ecc71; padding: 10px 20px; border-radius: 6px; text-decoration: none; color: white; display: inline-block; margin-bottom: 20px; }
    </style>
</head>
<body>
    <h1>🚗 AutoVault - Vehicle Inventory</h1>
    <a href="add.php" class="add">+ Add New Vehicle</a>
    <table>
        <tr>
            <th>ID</th><th>Name</th><th>Type</th><th>Brand</th><th>Year</th><th>Price</th><th>Actions</th>
        </tr>
        <?php while ($row = pg_fetch_assoc($vehicles)): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['type'] ?></td>
            <td><?= $row['brand'] ?></td>
            <td><?= $row['year'] ?></td>
            <td>₹<?= number_format($row['price'], 2) ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id'] ?>" class="btn edit">Edit</a>
                <a href="delete.php?id=<?= $row['id'] ?>" class="btn delete" onclick="return confirm('Delete this vehicle?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>