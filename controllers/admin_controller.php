<?php

session_start();

require 'config/db.php';
require_once 'email_controller.php';

$errors = array();
$username = "";
$email = "";

// if user clicks the login button
if (isset($_POST['login_button'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // validation
    if (empty($username)) {
        $errors['username'] = "Username required";
    }
    if (empty($password)) {
        $errors['password'] = "Password required";
    }

    if (count($errors) === 0) {
        $sql = "SELECT * FROM admin WHERE email=? OR username=? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $username, $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user === null) {
            $errors['login_fail'] = "User not found";
        } else {
            if (password_verify($password, $user['password'])) {
                // login success
                $_SESSION['admin_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                header('location: admin_home.php');
                exit();
            } else {
                $errors['login_fail'] = "Wrong credentials";
            }
        }
    }
}

// user logout
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['admin_id']);
    unset($_SESSION['username']);
    unset($_SESSION['email']);
    header('location: admin_login.php');
    exit();
}

// if user clicks the forgot password button
if (isset($_POST['forgot_password'])) {
    $email = $_POST["email"];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Email address is invalid";
    }
    if (empty($email)) {
        $errors['email'] = "Email required";
    }

    $sql = "SELECT * FROM admin WHERE email=? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user === null && !empty($email)) {
        $errors['login_fail'] = "User not found";
    }

    if (count($errors) === 0) {
        $sql = "SELECT * FROM admin WHERE email='$email' LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_assoc($result);
        $token = $user['token'];
        header('location: password_message.php');
        send_adlink($email, $token);
        exit(0);
    }
}

// if user clicks the reset password button
if (isset($_POST['reset_button'])) {
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if (empty($password) || empty($password_confirm)) {
        $errors['password'] = "Password required";
    }
    if ($password !== $password_confirm) {
        $errors['password'] = "The two passwords do not match";
    }

    $password = password_hash($password, PASSWORD_DEFAULT);
    $email = $_SESSION["email"];

    if (count($errors) === 0) {
        $sql = "UPDATE admin SET password='$password' WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header('location: admin_login.php');
            exit(0);
        }
    }
}

function reset_password($token) {
    global $conn;
    $sql = "SELECT * FROM admin WHERE token='$token' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
    $_SESSION['email'] = $user['email'];
    header('location: admin_reset.php');
    exit(0);
}