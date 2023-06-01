<?php
require_once 'connection.php';

// Handling form submission
if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cep = $_POST['cep'];
    $logradouro = $_POST['logradouro'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];

    // Inserting data into the database
    $query = "INSERT INTO users (name_user, email_user, pass_user, cep_user, logradouro_user, bairro_user, cidade_user, estado_user) VALUES ('$name', '$email', '$password', '$cep', '$logradouro', '$bairro', '$cidade', '$estado')";
    $duplicationvalidation = "SELECT * FROM users WHERE email_user = '$email'"; 
    $result = mysqli_query($connection, $duplicationvalidation);
    if($result && mysqli_num_rows($result) == 0){
        if (mysqli_query($connection, $query)) {
            echo "Registration successful!";
            header('Location: login.php');
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($connection);
        }
    }
    else{
        print "You already have an account";
    }
    mysqli_close($connection);
}
?>
