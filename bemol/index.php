<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
</head>
<body>
    <h2>Registration Form</h2>
    <form method="post" action="register.php">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>

        <label for="cep">CEP:</label>
        <input type="number" name="cep" id="cep"><br><br>

        <label for="logradouro">Logradouro:</label>
        <input type="text" name="logradouro" id="rua" disabled required><br><br>

        <label for="bairro">Bairro:</label>
        <input type="text" name="bairro" id="bairro" disabled required><br><br>

        <label for="cidade">Cidade:</label>
        <input type="text" name="cidade" id="cidade" disabled required><br><br>

        <label for="estado">Estado:</label>
        <input type="text" name="estado" id="estado" disabled required><br><br>

        <input type="submit" name="register" value="Register">
    </form>
    <a href="login.php">Sign In</a>
    <script src="script.js"></script>
</body>
</html>
