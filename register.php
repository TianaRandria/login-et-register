
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Register</title>
</head>
<body>

<main>
    <form action="connect.php" method="post">
        <h1>Register</h1>
        <div>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username">
        </div>

        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password">
        </div>

        <section>
        <button type="submit" name="action" value="register">Register</button>
            <a href="login.php">Login</a>
        </section>
    </form>
</main>
</body>
</html>