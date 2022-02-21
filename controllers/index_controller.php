<?php

$array = array();
$arrayPOSTED = array();
$arrayCATEGORY = array();
$owner = $_SESSION['username'];
$error = "";

// posted items
$sql = "SELECT * FROM items WHERE item_owne='$owner'";
$result = mysqli_query($conn, $sql);
$index = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $arrayPOSTED[$index] = $row;
    $index++;
}

// categories
$sql = "SELECT * FROM categories";
$result = mysqli_query($conn, $sql);
$index = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $arrayCATEGORY[$index] = $row;
    $index++;
}

// if user clicks the select button
if (isset($_GET['select_button'])) {
    $selected = $_GET['select'];

    if ($selected === "") {
        $sql = "SELECT * FROM items";
        $result = mysqli_query($conn, $sql);
        $index = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $array[$index] = $row;
            $index++;
        }
        if ($index === 0) {
            $error = "No results found";
        }
    } else {
        $sql = "SELECT * FROM items WHERE item_cate='$selected'";
        $result = mysqli_query($conn, $sql);
        $index = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $array[$index] = $row;
            $index++;
        }
        if ($index === 0) {
            $error = "No results found";
        }
    }
}

// if user clicks the search button
if (isset($_GET['search_button'])) {
    $keyword = $_GET['search'];

    if (empty($keyword)) {
        $error = "No results found";
    }

    if ($error === "") {
        $sql = "SELECT * FROM items WHERE item_name LIKE '%$keyword%'";
        $result = mysqli_query($conn, $sql);
        $index = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $array[$index] = $row;
            $index++;
        }
        if ($index === 0) {
            $error = "No results found";
        }
    }
}

// if user clicks the submit button
if (isset($_POST['submit_button'])) {
    $offer_name = $_POST['offer_name'];
    $offer_cond = $_POST['offer_cond'];
    $offer_desc = $_POST['offer_desc'];
    $offer_imag = $_FILES['offer_imag']['name'];
    $offer_owne = $_SESSION['username'];
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
            header('location: index.php');
            exit();
        }
    }
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

    $sql = "INSERT INTO offers (offer_name, offer_cond, offer_desc, offer_imag, offer_owne, item_id) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssssi', $offer_name, $offer_cond, $offer_desc, $offer_imag, $offer_owne, $item_id);
    if ($stmt->execute()) {
        $sql = "DELETE FROM items WHERE id = '$offer_id'";
        if (mysqli_query($conn, $sql)) {
            header('location: index.php');
            exit();
        }
    }
}