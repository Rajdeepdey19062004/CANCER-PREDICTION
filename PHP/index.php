<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CANCER PREDICTION</title>
    <link rel="stylesheet" href="css/custom.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>CANCER PREDICTION</h2>
        <form method="post" action="process.php">
            <label for="radius_mean">RADIUS MEAN:</label>
            <input type="number" step="0.01" id="radius_mean" name="radius_mean" required><br>

            <label for="texture_mean">TEXTURE MEAN:</label>
            <input type="number" step="0.01" id="texture_mean" name="texture_mean" required><br>

            <label for="perimeter_mean">PERIMETER MEAN:</label>
            <input type="number" step="0.01" id="perimeter_mean" name="perimeter_mean" required><br>

            <button type="submit">PREDICT</button>
        </form>
    </div>
</body>
</html>