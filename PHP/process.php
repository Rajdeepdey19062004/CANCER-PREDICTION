<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

$radius_mean = $_POST["radius_mean"];
$texture_mean = $_POST["texture_mean"];
$perimeter_mean = $_POST["perimeter_mean"];

// Run Python script
$command = escapeshellcmd("python3 ../PYTHON/a.py $radius_mean $texture_mean $perimeter_mean");
$output = shell_exec($command);
$result = trim($output);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PREDICTION RESULT</title>
    <link rel="stylesheet" href="css/custom.css">
    <style>
        .loader { display: block; }
    </style>
</head>
<body>
    <div class="loader"></div>

    <div class="result-container" style="display: none;">
        <?php if ($result == "1"): ?>
            <h2 style="color: #dc2626;">CANCER DETECTED</h2>
            <img src="IMAGES/d.jpg" alt="CANCER DETECTED" width="300">
        <?php else: ?>
            <h2 style="color: #16a34a;">NO CANCER</h2>
            <img src="IMAGES/h.jpg" alt="NO CANCER" width="300">
        <?php endif; ?>

        <a href="index.php">GO BACK</a>
    </div>

    <script>
        setTimeout(() => {
            document.querySelector('.loader').style.display = 'none';
            document.querySelector('.result-container').style.display = 'block';
        }, 1500);
    </script>
</body>
</html>
