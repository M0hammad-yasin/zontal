<?php

session_start();

include "config.php";

// Login Actions For Admin Panel 

if (isset($_POST['login'])) {

    $email_username = mysqli_real_escape_string($con, $_POST['username_email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $query = "select * from zon_users where username='$email_username' && password='$password'";
    $row = mysqli_fetch_assoc(mysqli_query($con, $query));
    if (mysqli_num_rows(mysqli_query($con, $query)) !== 0) {
        if ($row['is_admin'] == 1) {
            if ($row['status'] == 0) {

                $_SESSION['admin-Loggedin'] = true;

                @header("Location: ../index");
            } else {
                @header("Location: ../login?error=Your account is closed");
            }
        } else {
            @header("Location: ../login?error=Wrong username and password");
        }
    } else {
        @header("Location: ../login?error=Wrong username and password");
    }
}