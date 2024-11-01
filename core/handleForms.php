<?php 
require_once 'dbConfig.php';
require_once 'models.php';
session_start();


if (isset($_POST['loginBtn'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $errors = [];
    if (empty($username)) {
        $errors['username'] = "Username is required.";
    }
    if (empty($password)) {
        $errors['password'] = "Password is required.";
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: ../login.php");
        exit;
    }

    $user = loginUser($pdo, $username, $password);
    if ($user) {
        $_SESSION['user'] = $user;
        header("Location: ../index.php");
        exit;
    } else {
        $_SESSION['errors']['general'] = "Username doesn't exist from the database. You may consider registration first";
        header("Location: ../login.php");
        exit;
    }
}

if (isset($_POST['insertCrocheterBtn'])) {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $repeatPassword = trim($_POST['repeatPassword']);
    $first_name = trim($_POST['firstName']);
    $last_name = trim($_POST['lastName']);
    $date_of_birth = trim($_POST['dateOfBirth']);
    $phone_number = trim($_POST['phoneNumber']);
    $email_address = trim($_POST['emailAddress']);
    $expertise = trim($_POST['expertise']);

    $errors = [];

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['form_data'] = $_POST;
        header("Location: ../register.php");
        exit;
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $result = insertCrocheter($pdo, $username, $hashed_password, $first_name, $last_name, $date_of_birth, $phone_number, $email_address, $expertise);

        if ($result === true) {
            header("Location: ../index.php");
            exit;
        } else {
            $_SESSION['errors'] = ['general' => $result['error']];
            $_SESSION['form_data'] = $_POST;
            header("Location: ../register.php");
            exit;
        }
    }
}

if (isset($_POST['editCrocheterBtn'])) {
    $crocheterId = $_GET['crocheter_id'];
    $username = $_POST['username'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $phoneNumber = $_POST['phoneNumber'];
    $emailAddress = $_POST['emailAddress'];
    $expertise = $_POST['expertise'];
    $password = $_POST['password'];
    $repeatPassword = $_POST['repeatPassword'];

    if (!empty($password) && $password !== $repeatPassword) {
        echo "Passwords do not match!";
        exit();
    }

    $query = updateCrocheter($pdo, $username, $firstName, $lastName, $dateOfBirth, $phoneNumber, $emailAddress, $expertise, $password, $crocheterId);

    if ($query) {
        header("Location: ../profile.php");
        exit();
    } else {
        echo "Edit failed";
    }
}


if (isset($_POST['deleteCrocheterBtn'])) {
    $query = deleteCrocheter($pdo, $_GET['crocheter_id']);

    if ($query) {
		session_start();
		session_unset();
		session_destroy();

		header("Location: ../login.php");
		exit;
    } else {
        echo "Deletion failed";
    }
}

if (isset($_POST['insertNewProjectBtn'])) {
    $query = insertProject($pdo, $_POST['projectName'], $_POST['typeOfCrochet'], $_GET['crocheter_id']);

    if ($query) {
        header("Location: ../projects.php?crocheter_id=" . $_GET['crocheter_id']);
        exit();
    } else {
        echo "Insertion failed";
    }
}

if (isset($_POST['editProjectBtn'])) {
    $query = updateProject($pdo, $_POST['projectName'], $_POST['typeOfCrochet'], $_GET['project_id'], $_GET['crocheter_id']);

    if ($query) {
        header("Location: ../projects.php?crocheter_id=" . $_GET['crocheter_id']);
        exit();
    } else {
        echo "Update failed";
    }
}

if (isset($_POST['deleteProjectBtn'])) {
    $query = deleteProject($pdo, $_GET['project_id']);

    if ($query) {
        header("Location: ../projects.php?crocheter_id=" . $_GET['crocheter_id']);
        exit();
    } else {
        echo "Deletion failed";
    }
}

?>