<?php
session_start();

$errors = [];
$validated = [];

function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

function validate_url($url) {
    return filter_var($url, FILTER_VALIDATE_URL);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST['name']) || !preg_match("/^[a-zA-Z ]*$/", $_POST['name'])) {
        $errors['name'] = "Name is required and should only contain letters and spaces.";
    } else {
        $validated['name'] = sanitize_input($_POST['name']);
    }

    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "A valid email is required.";
    } else {
        $validated['email'] = sanitize_input($_POST['email']);
    }

    if (empty($_POST['password']) || strlen($_POST['password']) < 8 || !preg_match("/[A-Za-z]/", $_POST['password']) || !preg_match("/[0-9]/", $_POST['password'])) {
        $errors['password'] = "Password must be at least 8 characters long and include both letters and numbers.";
    } else {
        $validated['password'] = $_POST['password'];
    }

    if ($_POST['password'] !== $_POST['confirm_password']) {
        $errors['confirm_password'] = "Passwords do not match.";
    }

    if (empty($_POST['gender'])) {
        $errors['gender'] = "Gender is required.";
    } else {
        $validated['gender'] = sanitize_input($_POST['gender']);
    }

    if (empty($_POST['country'])) {
        $errors['country'] = "Please select a country.";
    } else {
        $validated['country'] = sanitize_input($_POST['country']);
    }

    if (empty($_POST['facebook']) || !validate_url($_POST['facebook'])) {
        $errors['facebook'] = "A valid Facebook URL is required.";
    } else {
        $validated['facebook'] = sanitize_input($_POST['facebook']);
    }

    if (empty($_POST['skills'])) {
        $errors['skills'] = "Please select at least one skill.";
    } else {
        $validated['skills'] = $_POST['skills'];
    }

    if (empty($_POST['biography']) || strlen($_POST['biography']) > 200) {
        $errors['biography'] = "Biography is required and must not exceed 200 characters.";
    } else {
        $validated['biography'] = sanitize_input($_POST['biography']);
    }

    if (empty($_POST['phone']) || !is_numeric($_POST['phone'])) {
        $errors['phone'] = "Phone number must be numeric.";
    } else {
        $validated['phone'] = sanitize_input($_POST['phone']);
    }

    if (empty($errors)) {
        $_SESSION['form_data'] = $validated;
        header("Location: about.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- 21-UR-0135 / TARAPE,JOHN CARLO C. -->
</head>
<body>
    <div class="container mt-5">
        <h2>Registration Form</h2>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form action="form.php" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Gender</label><br>
                <input type="radio" name="gender" value="Male" required> Male
                <input type="radio" name="gender" value="Female" required> Female
            </div>

            <div class="mb-3">
                <label for="country" class="form-label">Country</label>
                <select class="form-select" id="country" name="country" required>
                    <option value="">Select Country</option>
                    <option value="Philippines">Philippines</option>
                    <option value="US">US</option>
                    <option value="China">China</option>
                    <option value="Japan">Japan</option>
                    <option value="Brazil">Brazil</option>
                    <option value="Germany">Germany</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="facebook" class="form-label">Facebook URL</label>
                <input type="url" class="form-control" id="facebook" name="facebook" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Skills</label><br>
                <input type="checkbox" name="skills[]" value="PHP"> PHP
                <input type="checkbox" name="skills[]" value="JavaScript"> JavaScript
                <input type="checkbox" name="skills[]" value="HTML"> HTML
                <input type="checkbox" name="skills[]" value="Figma"> Figma
                <input type="checkbox" name="skills[]" value="Laravel"> Laravel
                <input type="checkbox" name="skills[]" value="AdobeXD"> AdobeXD
                <input type="checkbox" name="skills[]" value="Java"> Java
                <input type="checkbox" name="skills[]" value="C++"> C++
                <input type="checkbox" name="skills[]" value="C#"> C#
                <input type="checkbox" name="skills[]" value="C"> C
            </div>

            <div class="mb-3">
                <label for="biography" class="form-label">Biography</label>
                <textarea class="form-control" id="biography" name="biography" rows="4" maxlength="200" required></textarea>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>

            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
</body>
</html>
