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
    $redirectURL = "CancelAppointment.php";
}
else
{
    $appointmentID = @$_POST['cmb_appointments'];

    $query = "UPDATE TBL_APPOINTMENTS SET iscancelled = 1 WHERE id = " . $appointmentID;

    if ($conn->query($query) === TRUE)
    {
        $message = "Appointment canceled successfully.";
        $redirectURL = "PatientHomePage.php";
    }
    else
    {
        $message =  "Cancel failed! Error : " . $conn->error;
        $redirectURL = "CancelAppointment.php";
    }

    $_SESSION["message"] = $message;
    $_SESSION["redirectURL"] = $redirectURL;
}
$conn->close();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"  "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Cancel Appointment Result Page</title>
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