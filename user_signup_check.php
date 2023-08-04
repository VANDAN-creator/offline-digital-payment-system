<?php
session_start();
include "db_conn.php";

if (isset($_POST['name']) && isset($_POST['email'])
    && isset($_POST['pn']) && isset($_POST['an']) && isset($_POST['rn']) && isset($_POST['mn'])) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $name = validate($_POST['name']);
    $email = validate($_POST['email']);

    $pn = validate($_POST['pn']);
    $an = validate($_POST['an']);
    $rn = validate($_POST['rn']);
    $mn = validate($_POST['mn']);

    $user_data = '&name=' . $name . '&email=' . $email . '&pn=' . $pn . '&an=' . $an . '&rn=' . $rn . '&mn=' . $mn;

    if (empty($name)) {
        header("Location: user_signup.php?error=Name is required&$user_data");
        exit();
    } else if (empty($email)) {
        header("Location: user_signup.php?error=Email is required&$user_data");
        exit();
    } else if (empty($pn)) {
        header("Location: user_signup.php?error=Pan Card Number is required&$user_data");
        exit();
    } else if (empty($an)) {
        header("Location: user_signup.php?error=Aadhar Card Number is required&$user_data");
        exit();
    } else if (empty($rn)) { 
        header("Location: user_signup.php?error=Ration Card Number is required&$user_data");
        exit();
    } else if (empty($mn)) {
        header("Location: user_signup.php?error=Mobile Number is required&$user_data");
        exit();
    } else {
        $sql2 = "INSERT INTO usernames (name, email, pn, an, rn, mn) VALUES ('$name', '$email', '$pn', '$an', '$rn', '$mn')";
        $result2 = mysqli_query($conn, $sql2);
        if ($result2) {
            header("Location: user_signup.php?success=User has been added successfully");
            exit();
        } else {
            $error_message = mysqli_error($conn); // Get the specific error message
            header("Location: user_signup.php?error=Unknown error occurred: $error_message&$user_data");
            exit();
        }
    }

} else {
    header("Location: user_signup.php");
    exit();
}
