<?php

require_once 'auth_controller.php';

$array = array();
$arrayITEMS = array();
$arrayOFFERS = array();
$userOFFERS = array();
$arrayRATINGS = array();
$arrayCATEGORY = array();
$user_id = $_SESSION['id'];
$owner = $_SESSION['username'];

// item display
$sql = "SELECT * FROM items WHERE item_owne='$owner'";
$result = mysqli_query($conn, $sql);
$index = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $array[$index] = $row;
    $index++;
}

// offer display
$sql = "SELECT * FROM offers WHERE offer_owne='$owner'";
$result = mysqli_query($conn, $sql);
$index = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $arrayOFFERS[$index] = $row;
    $index++;
}

// ratings and reviews
$sql = "SELECT * FROM ratings  WHERE owner_id='$user_id' ";
$resultRATINGS = mysqli_query($conn, $sql);
$indexRATINGS = 0;
while ($rowRATINGS = mysqli_fetch_assoc($resultRATINGS)) {
    $arrayRATINGS[$indexRATINGS] = $rowRATINGS;
    $indexRATINGS++;
}

// categories
$sql = "SELECT * FROM categories";
$result = mysqli_query($conn, $sql);
$index = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $arrayCATEGORY[$index] = $row;
    $index++;
}

// if user clicks the submit button
if (isset($_POST['submit_button'])) {
    $item_name = $_POST['item_name'];
    $item_cond = $_POST['item_cond'];
    $item_desc = $_POST['item_desc'];
    $item_cate = $_POST['item_cate'];
    $item_imag = $_FILES['item_imag']['name'];
    $item_owne = $_SESSION['username'];

    if (!empty($item_imag)) {
        $item_imag = time() . '_' . $item_owne . '_' . $item_imag;
    }

    $target = "product_images/" . $item_imag;

    // image upload
    if (move_uploaded_file($_FILES['item_imag']['tmp_name'], $target)) {
        $sql = "INSERT INTO items (item_name, item_cond, item_desc, item_cate, item_imag, item_owne) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssssss', $item_name, $item_cond, $item_desc, $item_cate, $item_imag, $item_owne);
        if ($stmt->execute()) {
            header('location: profile.php');
            exit();
        }
    }
}

// if user clicks the save button (item)
if (isset($_POST['save_item_button'])) {
    $item_id = $_POST['item_id'];
    $item_desc = $_POST['item_desc'];
    $item_cond = $_POST['item_cond'];
    $item_imag = $_FILES['item_imag']['name'];
    $item_owne = $_SESSION['username'];

    if (!empty($item_imag)) {
        $item_imag = time() . '_' . $item_owne . '_' . $item_imag;
    }

    $target = "product_images/" . $item_imag;

    if (move_uploaded_file($_FILES['item_imag']['tmp_name'], $target)) {
        $sql = "UPDATE items SET item_desc = '$item_desc', item_cond = '$item_cond', item_imag = '$item_imag' WHERE id = '$item_id'";
        if (mysqli_query($conn, $sql)) {
            header('location: profile.php');
            exit();
        }
    }
}

// if user clicks the save button (offer)
if (isset($_POST['save_offer_button'])) {
    $offer_id = $_POST['item_id'];
    $offer_desc = $_POST['offer_desc'];
    $offer_cond = $_POST['offer_cond'];
    $offer_imag = $_FILES['offer_imag']['name'];
    $offer_owne = $_SESSION['username'];

    if (!empty($offer_imag)) {
        $offer_imag = time() . '_' . $offer_owne . '_' . $offer_imag;
    }

    $target = "product_images/" . $offer_imag;

    if (move_uploaded_file($_FILES['offer_imag']['tmp_name'], $target)) {
        $sql = "UPDATE offers SET offer_desc = '$offer_desc', offer_cond = '$offer_cond', offer_imag = '$offer_imag' WHERE id = '$offer_id'";
        if (mysqli_query($conn, $sql)) {
            header('location: profile.php');
            exit();
        }
    }
}

// if user clicks the delete button
if (isset($_POST['delete_button'])) {
    $item_id = $_POST['item_id'];

    $sql = "DELETE FROM items WHERE id = '$item_id'";
    if (mysqli_query($conn, $sql)) {
        header('location: profile.php');
        exit();
    }
}

// if user clicks the cancel button
if (isset($_POST['cancel_button'])) {
    $item_id = $_POST['item_id'];

    $sql = "DELETE FROM offers WHERE id = '$item_id'";
    if (mysqli_query($conn, $sql)) {
        header('location: profile.php');
        exit();
    }
}

// if user clicks the reject button
if (isset($_POST['reject_offer'])) {
    $item_id = $_POST['item_id'];

    $sql = "DELETE FROM offers WHERE id = '$item_id'";
    if (mysqli_query($conn, $sql)) {
        header('location: profile.php');
        exit();
    }
}