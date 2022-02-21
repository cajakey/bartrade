<?php

session_start();

require 'config/db.php';
require_once 'email_controller.php';

$errors = array();
$username = "";
$email = "";

// if user clicks the sign up button
if (isset($_POST['signup_button'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $profile_image = "";
    $bio = "";
    $interests = "";
    $rating = 0;

    // validation
    if (!ctype_alnum($username)) {
        $errors['username'] = "Username is invalid";
    }
    if (empty($username)) {
        $errors['username'] = "Username required";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Email address is invalid";
    }
    if (empty($email)) {
        $errors['email'] = "Email required";
    }
    if (empty($password)) {
        $errors['password'] = "Password required";
    }
    if ($password !== $password_confirm) {
        $errors['password'] = "The two passwords do not match";
    }
    if (empty($phone)) {
        $errors['phone'] = "Phone number required";
    }
    if (empty($address)) {
        $errors['address'] = "Shipping address required";
    }

    $email_query = "SELECT * FROM users WHERE email=? OR username=? LIMIT 1";
    $stmt = $conn->prepare($email_query);
    $stmt->bind_param('ss', $email, $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user_count = $result->num_rows;
    $stmt->close();

    if ($user_count > 0) {
        $errors['email'] = "User already exists";
    }

    if (count($errors) === 0) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $token = bin2hex(random_bytes(50));
        $verified = false;
        $deactivate = false;

        $sql = "INSERT INTO users (username, email, verified, token, password, phone, address, deactivate) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssbssssb', $username, $email, $verified, $token, $password, $phone, $address, $deactivate);
        if ($stmt->execute()) {
            // user login
            $user_id = $conn->insert_id;
            $_SESSION['id'] = $user_id;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['verified'] = $verified;
            $_SESSION['phone'] = $phone;
            $_SESSION['address'] = $address;
            $_SESSION['profile_image'] = $profile_image;
            $_SESSION['bio'] = $bio;
            $_SESSION['interests'] = $interests;
            $_SESSION['rating'] = $rating;
            $_SESSION['deactivate'] = $deactivate;
            header('location: index.php');
            send_verification($email, $token);
            exit();
        } else {
            $errors['db_error'] = "Database error: failed to register";
        }
    }
}

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
        $sql = "SELECT * FROM users WHERE email=? OR username=? LIMIT 1";
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
                $_SESSION['id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['verified'] = $user['verified'];
                $_SESSION['phone'] = $user['phone'];
                $_SESSION['address'] = $user['address'];
                $_SESSION['profile_image'] = $user['profile_image'];
                $_SESSION['bio'] = $user['bio'];
                $_SESSION['interests'] = $user['interests'];
                $_SESSION['rating'] = $user['rating'];
                $_SESSION['deactivate'] = $user['deactivate'];
                header('location: index.php');
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
    unset($_SESSION['id']);
    unset($_SESSION['username']);
    unset($_SESSION['email']);
    unset($_SESSION['verified']);
    unset($_SESSION['phone']);
    unset($_SESSION['address']);
    header('location: login.php');
    exit();
}

function verify_user($token) {
    global $conn;
    $sql = "SELECT * FROM users WHERE token='$token' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $update_query = "UPDATE users SET verified=1 WHERE token='$token'";

        if (mysqli_query($conn, $update_query)) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['verified'] = 1;
            $_SESSION['phone'] = $user['phone'];
            $_SESSION['address'] = $user['address'];
            $_SESSION['profile_image'] = $user['profile_image'];
            $_SESSION['bio'] = $user['bio'];
            $_SESSION['interests'] = $user['interests'];
            $_SESSION['rating'] = $user['rating'];
            $_SESSION['deactivate'] = $user['deactivate'];
            header('location: index.php');
            exit();
        }
    } else {
        echo 'User not found';
    }
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

    $sql = "SELECT * FROM users WHERE email=? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user === null && !empty($email)) {
        $errors['login_fail'] = "User not found";
    }

    if (count($errors) === 0) {
        $sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_assoc($result);
        $token = $user['token'];
        header('location: password_message.php');
        send_link($email, $token);
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
        $sql = "UPDATE users SET password='$password' WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header('location: login.php');
            exit(0);
        }
    }
}

function reset_password($token) {
    global $conn;
    $sql = "SELECT * FROM users WHERE token='$token' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
    $_SESSION['email'] = $user['email'];
    header('location: reset_password.php');
    exit(0);
}