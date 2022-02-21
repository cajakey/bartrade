<?php

require_once 'auth_controller.php';

$arrayRATINGS = array();
$arrayITEMS = array();
$username = $_GET['owner'];

// visited user
$owner_query = "SELECT * FROM users WHERE username=? LIMIT 1";
$stmt = $conn->prepare($owner_query);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();
$user_count = $result->num_rows;
$stmt->close();

if ($user_count == 0) {
   error_reporting(0);
} else {
    $sql = "SELECT * FROM users WHERE username=? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    // reviews
    $profile = $user['id'];
    $sql = "SELECT * FROM ratings  WHERE owner_id='$profile' ";
    $resultRATINGS = mysqli_query($conn, $sql);
    $indexRATINGS = 0;
    while ($rowRATINGS = mysqli_fetch_assoc($resultRATINGS)) {
        $arrayRATINGS[$indexRATINGS] = $rowRATINGS;
        $indexRATINGS++;
    }
    // user posts
    $profile_user = $user['username'];
    $sql = "SELECT * FROM items where item_owne='$profile_user'";
    $resultITEMS = mysqli_query($conn, $sql);
    $indexITEMS = 0;
    while ($rowITEMS = mysqli_fetch_assoc($resultITEMS)) {
        $arrayITEMS[$indexITEMS] = $rowITEMS;
        $indexITEMS++;
    }
}

// if user clicks the submit button
if (isset($_GET['submit_button'])) {
    $rating = $_GET['stars'];
    $review = $_GET['review'];
    $visitor_id = $_SESSION['id'];
    $visitor_username = $_SESSION['username'];
    $owner_id = $_GET['owner_id'];
    $owner_us = $_GET['owner_us'];

    $sql = "INSERT INTO ratings (visitor_id, owner_id, username, rating, review) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iisss', $visitor_id, $owner_id, $visitor_username, $rating, $review);
    if ($stmt->execute()) {
        $sql = "SELECT * FROM ratings WHERE owner_id='$owner_id'";
        $result = mysqli_query($conn, $sql);
        // rating computation
        $total = 0;
        $count = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $total += $row['rating'];
            $count++;
        }
        $average = $total / $count;

        $sql = "UPDATE users SET rating = '$average' WHERE id='$owner_id'";
        if (mysqli_query($conn, $sql)) {
            header('location: visit.php?owner=' . $owner_us);
            exit();
        }
    }
}

// if user clicks the propose button
if (isset($_POST['propose_button'])) {
    $offer_name = $_POST['offer_name'];
    $offer_cond = $_POST['offer_cond'];
    $offer_desc = $_POST['offer_desc'];
    $offer_imag = $_FILES['offer_imag']['name'];
    $offer_owne = $_SESSION['username'];
    $item_owne = $_POST['item_owne'];
    $item_id = $_POST['item_id'];

    if (!empty($offer_imag)) {
        $offer_imag = time() . '_' . $offer_owne . '_' . $offer_imag;
    }

    $target = "product_images/" . $offer_imag;

    // image upload
    if (move_uploaded_file($_FILES['offer_imag']['tmp_name'], $target)) {
        $sql = "INSERT INTO offers (offer_name, offer_cond, offer_desc, offer_imag, offer_owne, item_id) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssssi', $offer_name, $offer_cond, $offer_desc, $offer_imag, $offer_owne, $item_id);
        if ($stmt->execute()) {
            header('location: visit.php?owner=' . $item_owne);
            exit();
        }
    }
}

$arrayPOSTED = array();
$owner = $_SESSION['username'];

$sql = "SELECT * FROM items WHERE item_owne='$owner'";
$result = mysqli_query($conn, $sql);
$index = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $arrayPOSTED[$index] = $row;
    $index++;
}

// if user clicks the trade button
if (isset($_POST['trade_button'])) {
    $offer_id = $_POST['offer_id'];
    $item_id = $_POST['item_id'];

    $sql = "SELECT * FROM items WHERE id='$offer_id'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $array[0] = $row;
    }

    $offer_name = $array[0]['item_name'];
    $offer_cond = $array[0]['item_cond'];
    $offer_desc = $array[0]['item_desc'];
    $offer_imag = $array[0]['item_imag'];
    $offer_owne = $_SESSION['username'];
    $item_owne = $_POST['item_owne'];

    $sql = "INSERT INTO offers (offer_name, offer_cond, offer_desc, offer_imag, offer_owne, item_id) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssssi', $offer_name, $offer_cond, $offer_desc, $offer_imag, $offer_owne, $item_id);
    if ($stmt->execute()) {
        $sql = "DELETE FROM items WHERE id = '$offer_id'";
        if (mysqli_query($conn, $sql)) {
            header('location: visit.php?owner=' . $item_owne);
            exit();
        }
    }
}

// if user clicks the report button
if (isset($_GET['report_button'])) {
    $owner_id = $_GET['id'];
    $owner_us = $_GET['username'];

    $sql = "UPDATE users SET report = report + 1 WHERE id='$owner_id'";
    if (mysqli_query($conn, $sql)) {
        header('location: visit.php?owner=' . $owner_us);
        exit();
    }
}