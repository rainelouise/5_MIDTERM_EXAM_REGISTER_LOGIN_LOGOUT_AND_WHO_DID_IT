<?php
require_once 'core/auth.php';
redirectIfAuthenticated(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Log In</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }
        body {
            background: linear-gradient(135deg, #F88993, #F6B5AD);
            color: #4b4b4b;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 2em;
            border-radius: 15px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
        }
        .logo {
            width: 100px;
            height: auto;
            margin-bottom: 10px;
        }
        h1 {
            font-size: 2em;
            color: #F88993;
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
        }
        form {
            background-color: #ffffff;
            padding: 2em;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 350px;
            text-align: left;
        }
        label {
            font-size: 1em;
            color: #F88993;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            margin-bottom: 15px;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            border-radius: 8px;
            transition: border-color 0.3s;
        }
        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #F88993;
        }
        .submit-container {
            display: flex;
            justify-content: center;
        }
        input[type="submit"] {
            background-color: #F88993;
            color: #ffffff;
            padding: 12px 25px;
            font-size: 1em;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }
        input[type="submit"]:hover {
            background-color: #e66767;
            transform: scale(1.05);
        }
        .error {
            color: #ff4d4d;
            font-size: 0.85em;
            margin-bottom: 10px;
            display: block;
        }
        p {
            margin-top: 1.5em;
            color: #4b4b4b; 
        }
        a {
            color: #F88993;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
        }
        a:hover {
            color: #F6B5AD;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="images/LOGO V3.png" alt="Peachy Stitches Logo" class="logo">
        <h1>Login</h1>
        <form action="core/handleForms.php" method="POST">
            <p>
                <label for="username">Username</label> 
                <input type="text" name="username" required>
                <?php if (isset($_SESSION['errors']['username'])): ?>
                    <span class="error"><?= $_SESSION['errors']['username'] ?></span>
                <?php endif; ?>
            </p>
            <p>
                <label for="password">Password</label> 
                <input type="password" name="password" required>
                <?php if (isset($_SESSION['errors']['password'])): ?>
                    <span class="error"><?= $_SESSION['errors']['password'] ?></span>
                <?php endif; ?>
            </p>
            <div class="submit-container">
                <input type="submit" name="loginBtn" value="Log In">
            </div>
            <?php if (isset($_SESSION['errors']['general'])): ?>
                <p class="error"><?= $_SESSION['errors']['general'] ?></p>
            <?php endif; ?>
        </form>
        <p>Don't have an account? You may register <a href="register.php">here</a></p>
    </div>
</body>
</html>