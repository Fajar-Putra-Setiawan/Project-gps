<?php
// Start a session
session_start();

// Check if the form has been submitted
if (isset($_POST['login'])) {
    // Get the entered username and password
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check the username and password against a list of valid credentials
    if ($username == 'admin' && $password == 'password') {
        // If the credentials are correct, store the user's information in session variables
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        // Redirect the user to the landing page
        header('Location: index.php');
        exit;
    } else {
        // If the credentials are invalid, show an error message
        $error = 'Invalid username or password';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="style2.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN PAGE</title>
</head>

<body>
    <form action="" method="post">
        <h2>Log In</h2>
        <?php if (isset($error)) {
            echo "<p>$error</p>";
        } ?>
        <label for="username">Username</label>
        <input type="text" name="username" id="username" class="form-control">
        <br>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control">
        <br>
        <button type="submit" class="btn btn-primary" name="login">Login</button>

    </form>
</body>

</html>