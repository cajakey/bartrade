<?php

require_once 'auth_controller.php';

$item_transac_id = $_GET['item_transac_id'];

$item_query = "SELECT * FROM offers WHERE id=? LIMIT 1";
$stmt = $conn->prepare($item_query);
$stmt->bind_param('i', $item_transac_id);
$stmt->execute();
$result = $stmt->get_result();
$item_count = $result->num_rows;
$stmt->close();

// Getting offer info from db
$sql = "SELECT * FROM offers WHERE id='$item_transac_id'";
$result = mysqli_query($conn, $sql);
$offer = mysqli_fetch_assoc($result);

// Getting your item info from db
$item_id = $offer['item_id'];
$sql = "SELECT * FROM items WHERE id='$item_id'";
$result = mysqli_query($conn, $sql);
$item = mysqli_fetch_assoc($result);

// Getting user info from db
$username = $offer['offer_owne'];
$sql = "SELECT * FROM users WHERE username='$username'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

// Accept offer
if (isset($_POST['confirm_trade'])) {
    $user1 = $_SESSION['username'];
    $user2 = $_POST['user2'];
    $location1 = $_SESSION['address'];
    $location2 = $_POST['location2'];
    $item1_name = $_POST['item1'];
    $item2_name = $_POST['item2'];
    $contact1 = $_SESSION['phone'];
    $contact2 = $_POST['contact2'];
    $email1 = $_SESSION['email'];
    $email2 = $_POST['email2'];
    $transaction_mode = $_POST['select'];
    $item_id = $_POST['item_id'];

    $sql = "INSERT INTO transactions (user1, user2, location1, location2, item1_name, item2_name, contact1, contact2, email1, email2, transaction_mode) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssssssssss', $user1, $user2, $location1, $location2, $item1_name, $item2_name, $contact1, $contact2, $email1, $email2, $transaction_mode);
    if ($stmt->execute()) {
        $sql = "DELETE FROM items WHERE id = '$item_id'";
        if (mysqli_query($conn, $sql)) {
            header('location: profile.php');
            exit();
        }
    }
}

// Reject offer
if (isset($_POST['reject_trade'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM offers WHERE id = '$id'";
    if (mysqli_query($conn, $sql)) {
        header('location: profile.php');
        exit();
    }
}