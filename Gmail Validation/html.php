<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        form {
            width: 300px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .error {
            color: red;
        }
        .success {
            color: green;
        }
    </style>
</head>
<body>
    <?php
    $name = $email = $password = $address = $gender = $message = "";
    $isValid = true;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = trim($_POST["name"]);
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);
        $address = trim($_POST["address"]);
        $gender = isset($_POST["gender"]) ? $_POST["gender"] : "";

        // Validation
        if (empty($name)) {
            $message .= "Name is required.<br>";
            $isValid = false;
        }
        if (empty($email)) {
            $message .= "Email is required.<br>";
            $isValid = false;
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $message .= "Invalid email format.<br>";
            $isValid = false;
        } elseif (!str_ends_with($email, "@gmail.com")) {
            $message .= "Email must be a Gmail address.<br>";
            $isValid = false;
        }
        if (empty($password)) {
            $message .= "Password is required.<br>";
            $isValid = false;
        } elseif (strlen($password) < 6) {
            $message .= "Password must be at least 6 characters long.<br>";
            $isValid = false;
        }
        if (empty($address)) {
            $message .= "Address is required.<br>";
            $isValid = false;
        }
        if (empty($gender)) {
            $message .= "Gender must be selected.<br>";
            $isValid = false;
        }

        // Success message
        if ($isValid) {
            $message = "Form submitted successfully!<br>";
            $message .= "Name: " . htmlspecialchars($name) . "<br>";
            $message .= "Email: " . htmlspecialchars($email) . "<br>";
            $message .= "Address: " . htmlspecialchars($address) . "<br>";
            $message .= "Gender: " . htmlspecialchars($gender) . "<br>";
        }
    }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>"><br><br>

        <label for="email">Gmail:</label><br>
        <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>"><br><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>

        <label for="address">Address:</label><br>
        <textarea id="address" name="address"><?php echo htmlspecialchars($address); ?></textarea><br><br>

        <label>Gender:</label><br>
        <input type="radio" id="male" name="gender" value="Male" <?php echo ($gender == "Male") ? "checked" : ""; ?>>
        <label for="male">Male</label><br>
        <input type="radio" id="female" name="gender" value="Female" <?php echo ($gender == "Female") ? "checked" : ""; ?>>
        <label for="female">Female</label><br>
        <input type="radio" id="other" name="gender" value="Other" <?php echo ($gender == "Other") ? "checked" : ""; ?>>
        <label for="other">Other</label><br><br>

        <button type="submit">Submit</button>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <p class="<?php echo $isValid ? 'success' : 'error'; ?>">
            <?php echo $message; ?>
        </p>
    <?php endif; ?>
</body>
</html>
