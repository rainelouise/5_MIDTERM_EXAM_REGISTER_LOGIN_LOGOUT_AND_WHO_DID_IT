<?php 
require_once 'core/auth.php';
redirectIfAuthenticated(); 
$errors = $_SESSION['errors'] ?? [];
$form_data = $_SESSION['form_data'] ?? [];
unset($_SESSION['errors'], $_SESSION['form_data']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Peachy Stitches Registration</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			background: linear-gradient(135deg, #F88993, #F6B5AD);
			margin: 0;
			padding:32px; 
		}

		form {
			max-width: 400px;
			margin: auto;
			background: white;
			padding: 15px; 
			border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
		}

		h1 {
			text-align: center;
			color: #F88993; 
			margin-bottom: 15px; 
		}

		p {
			margin-bottom: 10px; 
		}

		label {
			font-size: 0.9em; 
			color: #F88993;
			display: block;
			margin-bottom: 3px; 
		}

		input[type="text"],
		input[type="password"],
		input[type="date"],
		input[type="email"] {
			width: 100%;
			padding: 10px; 
			border: 1px solid #ccc;
			border-radius: 8px;
			box-sizing: border-box;
			margin-bottom: 5px; 
		}

		input[type="submit"] {
			background-color: #F88993; 
			color: white;
			padding: 10px; 
			border: none;
			border-radius: 8px;
			cursor: pointer;
			width: 100%;
			font-size: 15px; 
			transition: background-color 0.3s ease;
		}

		input[type="submit"]:hover {
			background-color: #e66767; 
		}

		.error {
			color: red;
			font-size: 0.8em; 
			margin-top: 3px; 
		}
	</style>
</head>
<body>
	<form action="core/handleForms.php" method="POST">
		<h1>Registration Form</h1>
		<p>
			<label for="username">Username</label> 
			<input type="text" name="username" value="<?= htmlspecialchars($form_data['username'] ?? '') ?>" required>
			<span class="error"><?= $errors['username'] ?? '' ?></span>
		</p>
		<p>
			<label for="password">Password</label> 
			<input type="password" name="password" required>
			<span class="error"><?= $errors['password'] ?? '' ?></span>
		</p>
		<p>
			<label for="firstName">First Name</label> 
			<input type="text" name="firstName" value="<?= htmlspecialchars($form_data['firstName'] ?? '') ?>" required>
			<span class="error"><?= $errors['firstName'] ?? '' ?></span>
		</p>
		<p>
			<label for="lastName">Last Name</label> 
			<input type="text" name="lastName" value="<?= htmlspecialchars($form_data['lastName'] ?? '') ?>" required>
			<span class="error"><?= $errors['lastName'] ?? '' ?></span>
		</p>
		<p>
			<label for="dateOfBirth">Date of Birth</label> 
			<input type="date" name="dateOfBirth" value="<?= htmlspecialchars($form_data['dateOfBirth'] ?? '') ?>" required>
			<span class="error"><?= $errors['dateOfBirth'] ?? '' ?></span>
		</p>
        <p>
			<label for="phoneNumber">Phone Number</label> 
			<input type="text" name="phoneNumber" value="<?= htmlspecialchars($form_data['phoneNumber'] ?? '') ?>" required>
			<span class="error"><?= $errors['phoneNumber'] ?? '' ?></span>
		</p>
        <p>
			<label for="emailAddress">Email Address</label> 
			<input type="email" name="emailAddress" value="<?= htmlspecialchars($form_data['emailAddress'] ?? '') ?>" required>
			<span class="error"><?= $errors['emailAddress'] ?? '' ?></span>
		</p>
		<p>
			<label for="expertise">Expertise</label> 
			<input type="text" name="expertise" value="<?= htmlspecialchars($form_data['expertise'] ?? '') ?>" required>
			<span class="error"><?= $errors['expertise'] ?? '' ?></span>
		</p>
        <p>
            <input type="submit" name="insertCrocheterBtn" value="Register">
		</p>
	</form>
</body>
</html>