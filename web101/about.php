<?php
session_start();

if (!isset($_SESSION['form_data'])) {
    echo "No form data available!";
    exit;
}

$form_data = $_SESSION['form_data'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Submission Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Form Submission Details</h2>
        <ul>
            <li><strong>Name:</strong> <?php echo $form_data['name']; ?></li>
            <li><strong>Email:</strong> <?php echo $form_data['email']; ?></li>
            <li><strong>Gender:</strong> <?php echo $form_data['gender']; ?></li>
            <li><strong>Country:</strong> <?php echo $form_data['country']; ?></li>
            <li><strong>Facebook URL:</strong> <?php echo $form_data['facebook']; ?></li>
            <li><strong>Skills:</strong> <?php echo implode(", ", $form_data['skills']); ?></li>
            <li><strong>Biography:</strong> <?php echo $form_data['biography']; ?></li>
            <li><strong>Phone:</strong> <?php echo $form_data['phone']; ?></li>
        </ul>
    </div>
</body>
</html>
