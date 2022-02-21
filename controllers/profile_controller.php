<?php

require_once 'auth_controller.php';

$msg = "";
$arrayRATINGS = array();
$user_id = $_SESSION['id'];

// ratings and reviews
$sql = "SELECT * FROM ratings  WHERE owner_id='$user_id' ";
$resultRATINGS = mysqli_query($conn, $sql);
$indexRATINGS = 0;
while ($rowRATINGS = mysqli_fetch_assoc($resultRATINGS)) {
    $arrayRATINGS[$indexRATINGS] = $rowRATINGS;
    $indexRATINGS++;
}

// if user clicks the save button
if (isset($_POST['save_button'])) {
    $bio = $_POST['bio'];
    $interests = implode(',',$_POST['interests']);
    $image_name = time() . '_' . $_FILES['profile_image']['name'];
    $target = "profile_images/" . $image_name;
    $id = $_SESSION['id'];

    // image upload
    if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $target)) {
        $sql = "UPDATE users SET profile_image = '$image_name', bio = '$bio', interests = '$interests' WHERE id = '$id'";
        if (mysqli_query($conn, $sql)) {
            $msg = "OK";
            $_SESSION['profile_image'] = $image_name;
            $_SESSION['bio'] = $bio;
            $_SESSION['interests'] = $interests;
        } else {
            $msg = "NOT OK";
        }
    } else {
        $sql = "UPDATE users SET bio = '$bio', interests = '$interests' WHERE id = '$id'";
        if (mysqli_query($conn, $sql)) {
            $msg = "OK";
            $_SESSION['bio'] = $bio;
            $_SESSION['interests'] = $interests;
        } else {
            $msg = "NOT OK";
        }
    }
}