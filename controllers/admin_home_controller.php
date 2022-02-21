<?php

$accountArray = array();

$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);
$index = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $accountArray[$index] = $row;
    $index++;
}

// if user clicks the reactivate button
if (isset($_POST['reactivate_button'])) {
    $id = $_POST['account_id'];
    $sql = "UPDATE users SET deactivate = 0 WHERE id = '$id'";
    if (mysqli_query($conn, $sql)) {
        header('location: admin_home.php');
        exit();
    }
}

// if user clicks the deactivate button
if (isset($_POST['deactivate_button'])) {
    $id = $_POST['account_id'];
    $sql = "UPDATE users SET deactivate = 1 WHERE id = '$id'";
    if (mysqli_query($conn, $sql)) {
        header('location: admin_home.php');
        exit();
    }
}

// if user clicks the add button
if (isset($_POST['add_button'])) {
    $category = $_POST['category'];
    $sql = "INSERT INTO categories (category) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $category);
    if ($stmt->execute()) {
        header('location: admin_home.php');
        exit();
    }
}