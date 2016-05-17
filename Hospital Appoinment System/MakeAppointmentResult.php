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
    $redirectURL = "DeleteDoctor.php";
}
else
{
    $doctorID = @$_POST['cmb_doctors'];
    $date = @$_POST['dtp_appointment'];


    $query = "SELECT COUNT(*) AS count FROM TBL_APPOINTMENTS WHERE iscancelled = 0 AND isdeleted = 0 AND doctor = " . $doctorID . " AND date = '" . $date . "'";

    $result = $conn->query($query);
    if ($result->num_rows > 0)
    {
        $row = $result->fetch_assoc();
        $count = $row["count"];

        if($count === "0")
        {
            $query = "INSERT INTO TBL_APPOINTMENTS (doctor,date,patient) VALUES ( " . $doctorID . ", '" . $date . "', " . $_SESSION["id"] . ")";

            if ($conn->query($query) === TRUE)
            {
                $message = "Appointment created successfully.";
                $redirectURL = "PatientHomePage.php";
            }
            else
            {
                $message =  "Appointment cannot created! Error : " . $conn->error;
                $redirectURL = "MakeAppointment.php";
            }
        }
        else
        {
            $message = "This doctor already has an appointment on this date! Try again.";
            $redirectURL = "MakeAppointment.php";
        }
    }
    else
    {
        $message =  "Appointment cannot created! Error : " . $conn->error;
        $redirectURL = "PatientHomePage.php";
    }

    $_SESSION["message"] = $message;
    $_SESSION["redirectURL"] = $redirectURL;
}
$conn->close();
?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Make Appointment Result Page</title>
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