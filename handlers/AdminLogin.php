<?php
session_start();
include('../Databsase/connection.php');

if (isset($_POST['login'])) {
    $email = $_POST['exampleInputEmail1'];
    $password = $_POST['exampleInputPassword11'];
    
    $sql = "SELECT * FROM `admin` WHERE email = ? AND password = ?";
    $stmt = mysqli_prepare($connection, $sql);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ss", $email, $password);

    // Execute query
    mysqli_stmt_execute($stmt);

    // Get result
    $result = mysqli_stmt_get_result($stmt);

    // Check if any rows are returned
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $_SESSION['idAdmin'] = $row['id'];
        header("location: ../Admin/index.php");
        exit();
    } else {
        
        echo "<script>alert('Invalid Email or Password');</script>";
        echo "<script>window.history.back()</script>";
    }
} else {
    echo "Invalid Access Method";
}
?>
