<?php
require 'db.php';
require_once 'vendor/autoload.php';

use MicrosoftAzure\Storage\Blob\BlobRestProxy;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $brand = $_POST['brand'];
    $year = $_POST['year'];
    $price = $_POST['price'];
    $image_url = '';

    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $blobClient = BlobRestProxy::createBlobService(
            "DefaultEndpointsProtocol=https;AccountName=" . AZURE_STORAGE_ACCOUNT . ";AccountKey=" . AZURE_STORAGE_KEY . ";EndpointSuffix=core.windows.net"
        );
        $fileName = time() . '_' . basename($_FILES['image']['name']);
        $fileContent = fopen($_FILES['image']['tmp_name'], 'r');
        $blobClient->createBlockBlob(AZURE_CONTAINER, $fileName, $fileContent);
        $image_url = "https://" . AZURE_STORAGE_ACCOUNT . ".blob.core.windows.net/" . AZURE_CONTAINER . "/" . $fileName;
    }

    pg_query($conn, "INSERT INTO vehicles (name, type, brand, year, price, image_url) VALUES ('$name', '$type', '$brand', $year, $price, '$image_url')");
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Vehicle - AutoVault</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: 40px auto; padding: 0 20px; background: #f4f4f4; }
        h1 { color: #333; }
        form { background: white; padding: 30px; border-radius: 8px; }
        input, select { width: 100%; padding: 10px; margin: 8px 0 16px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        label { font-weight: bold; color: #555; }
        button { background: #2ecc71; color: white; padding: 12px 24px; border: none; border-radius: 6px; cursor: pointer; font-size: 16px; }
        a { color: #3498db; text-decoration: none; display: inline-block; margin-top: 15px; }
    </style>
</head>
<body>
    <h1>➕ Add New Vehicle</h1>
    <form method="POST" enctype="multipart/form-data">
        <label>Vehicle Name</label>
        <input type="text" name="name" placeholder="e.g. Yamaha R15" required>

        <label>Type</label>
        <select name="type">
            <option value="Car">Car</option>
            <option value="Bike">Bike</option>
            <option value="Truck">Truck</option>
            <option value="SUV">SUV</option>
        </select>

        <label>Brand</label>
        <input type="text" name="brand" placeholder="e.g. Yamaha" required>

        <label>Year</label>
        <input type="number" name="year" placeholder="e.g. 2023" required>

        <label>Price (₹)</label>
        <input type="number" name="price" placeholder="e.g. 150000" step="0.01" required>

        <label>Vehicle Image</label>
        <input type="file" name="image" accept="image/*">

        <button type="submit">Add Vehicle</button>
    </form>
    <a href="index.php">← Back to list</a>
</body>
</html>