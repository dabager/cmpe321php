<?php
/**
 * @author : Umut M. Dabager <dabager@outlook.com>
 * Hospital Appointment System
 * Written for the Cmpe 321 Assignment 3
 */

session_start();

if (!(isset($_SESSION['login']) && $_SESSION['login'] === true))
{
    header ("Location: UnauthorizedAccess.php");
    exit();
}

$serverName = "localhost";
$username = "root";
$password = "Sf86ucj7CZ";
$database = "hospital";

$message = "";
$redirectURL = "";

$conn = new mysqli($serverName, $username, $password, $database);


if ($conn->connect_error)
{
    $message = "Connection failed: " . $conn->connect_error;
    $redirectURL = "EditDoctor.php";
}
else
{
    $doctorName = @$_POST['txt_name'];
    $doctorSurname = @$_POST['txt_surname'];
    $doctorBranch = @$_POST['cmb_branches'];
    $doctorAge = @$_POST['txt_age'];
    $doctorGender = @$_POST['cmb_gender'];


    $query = "UPDATE TBL_DOCTORS SET name = '" . $doctorName . "' , 
                                    surname = '" . $doctorSurname . "' , 
                                    branch = " . $doctorBranch . ", 
                                    age = " . $doctorAge . ", 
                                    gender = '" . $doctorGender . "'
                                    WHERE id = " . $_SESSION['editedDoctorID'];

    if ($conn->query($query) === TRUE)
    {
        $message = "Doctor updated successfully.";
        $redirectURL = "AdminHomePage.php";
    }
    else
    {
        $message =  "Update failed! Error : " . $conn->error;
        $redirectURL = "EditDoctor.php";
    }

    $_SESSION["message"] = $message;
    $_SESSION["redirectURL"] = $redirectURL;
    $_SESSION['editedDoctorID'] = null;
}
$conn->close();
?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Edit Doctor Result Page</title>
    <link rel="stylesheet" type="text/css" href="GlobalStyle.css">
</head>
<body>
<div class="center-div" style="width: 250px; height: 300px; background: #333333;">
    <table cellspacing="10" style="width: 200px;">
        <tr>
            <td class="center-label-td">Hospital Appointment System</td>
        </tr>
        <tr>
            <td class="center-label-td" style="font-weight: normal;"><?php echo $_SESSION["message"] ?></td>
        </tr>
        <tr>
            <td>
                <a href='<?php echo $_SESSION["redirectURL"] ?>'>
                    <input class="btn" type="submit" value="Go Back"/>
                </a>
            </td>
        </tr>
    </table>
</div>
</body>
</html>