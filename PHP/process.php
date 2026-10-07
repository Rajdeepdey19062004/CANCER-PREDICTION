<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

$fields = ["radius_mean", "texture_mean", "perimeter_mean"];
$measurements = [];
$error_message = null;

foreach ($fields as $field) {
    $raw_value = $_POST[$field] ?? null;
    $value = is_string($raw_value)
        ? filter_var($raw_value, FILTER_VALIDATE_FLOAT)
        : false;

    if ($value === false || !is_finite((float) $value)) {
        $error_message = "Enter valid numeric values for all measurements.";
        break;
    }

    $measurements[] = sprintf("%.12g", (float) $value);
}

$result = null;
if ($error_message === null) {
    $python_binary = getenv("PYTHON_BIN");
    if ($python_binary === false || $python_binary === "") {
        $python_binary = PHP_OS_FAMILY === "Windows" ? "python" : "python3";
    }

    $script_path = realpath(__DIR__ . "/../PYTHON/a.py");
    if ($script_path === false) {
        $error_message = "The prediction script is unavailable.";
    } else {
        $arguments = array_map("escapeshellarg", $measurements);
        $command = escapeshellarg($python_binary)
            . " "
            . escapeshellarg($script_path)
            . " "
            . implode(" ", $arguments);
        exec($command, $output_lines, $exit_code);

        $prediction = trim(implode("\n", $output_lines));
        if ($exit_code !== 0 || !in_array($prediction, ["0", "1"], true)) {
            error_log("Cancer prediction failed: " . $prediction);
            $error_message = "Prediction could not be completed. Check the server setup and try again.";
        } else {
            $result = $prediction;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PREDICTION RESULT</title>
    <link rel="stylesheet" href="css/custom.css">
</head>
<body>
    <div class="result-container">
        <?php if ($error_message !== null): ?>
            <h2>Prediction unavailable</h2>
            <p><?= htmlspecialchars($error_message, ENT_QUOTES, "UTF-8") ?></p>
        <?php elseif ($result === "1"): ?>
            <h2 style="color: #dc2626;">CANCER DETECTED</h2>
            <img src="IMAGES/d.jpg" alt="CANCER DETECTED" width="300">
        <?php elseif ($result === "0"): ?>
            <h2 style="color: #16a34a;">NO CANCER</h2>
            <img src="IMAGES/h.jpg" alt="NO CANCER" width="300">
        <?php endif; ?>

        <p>This educational model is not a medical diagnosis. Consult a qualified healthcare professional.</p>
        <a href="index.php">GO BACK</a>
    </div>
</body>
</html>
