<!DOCTYPE html>
<html>
<head>
    <title>Login Form</title>
</head>
<body>
    <h2>Login Form</h2>
    <form method="post" action="login.php">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>
        <input type="checkbox" name="remember" id="remember">
        <p>Remember me</p>
        <input type="submit" name="login" value="Login">
    </form>
    <a href="index.php">Sign Up</a>
</body>
</html>
<?php
require_once 'connection.php';
// Function to set a cookie with the email if "Remember Me" is checked
// Viadimho
function setRememberMe($email)
{
    $cookie_name = "remember_email";
    $cookie_value = $email;
    $cookie_expiration = time() + (60 * 60 * 24 * 30); // Cookie valid for 30 days
    setcookie($cookie_name, $cookie_value, $cookie_expiration, '/');
}

// Function to get the "Remember Me" cookie if it exists
function getRememberMe()
{
    $cookie_name = "remember_email";
    return $_COOKIE[$cookie_name] ?? '';
}

// Handling login form submission
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $remember_me = isset($_POST['remember']) ? true : false;


    // Fetching user from the database
    $query = "SELECT * FROM users WHERE email_user = '$email' AND pass_user = '$password'";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Debugging statements
        echo "Fetched email from database: " . $user['email_user'] . " and Password: " . $user['pass_user'] . "<br>";
        echo "Entered email: " . $email . "<br>";
        session_start();
        $_SESSION['user_id'] = $user['id_user']; // Assuming the user ID column is 'id' in the database
        header("Location: dashboard.php");
        exit();


        // Set the "Remember Me" cookie if checked
        if ($remember_me) {
            setRememberMe($email);
        }


    } else {
        echo "Invalid email or password!";
    }
}
$saved_email = getRememberMe();

?>
