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
    $redirectURL = "AddDoctor.php";
}
else
{
    $doctorName = @$_POST['txt_name'];
    $doctorSurname = @$_POST['txt_surname'];
    $doctorBranch = @$_POST['cmb_branches'];
    $doctorAge = @$_POST['txt_age'];
    $doctorGender = @$_POST['cmb_gender'];

    $query = "SELECT COUNT(*) AS count FROM TBL_DOCTORS WHERE isdeleted = 0 AND
                name = '" . $doctorName . "' AND
                surname = '" . $doctorSurname . "' AND
                branch = '" . $doctorBranch . "' AND
                age = " . $doctorAge . " AND
                gender = '" . $doctorGender . "'";
    
    $result = $conn->query($query);
    if ($result->num_rows > 0)
    {
        $row = $result->fetch_assoc();
        $count = $row["count"];

        if($count === "0")
        {
            $query = "INSERT INTO TBL_DOCTORS (name,surname,branch,age,gender) VALUES ( '" . $doctorName . "', '" . $doctorSurname . "', '" . $doctorBranch . "', " . $doctorAge . ", '" . $doctorGender . "')";

            if ($conn->query($query) === TRUE)
            {
                $message = "Doctor created successfully.";
                $redirectURL = "AdminHomePage.php";
            }
            else
            {
                $message =  "Record cannot created! Error : " . $conn->error;
                $redirectURL = "AddDoctor.php";
            }
        }
        else
        {
            $message = "Doctor already exists! Try again.";
            $redirectURL = "AddDoctor.php";
        }
    }
    else
    {
        $message =  "Error : " . $conn->error;
        $redirectURL = "AddDoctor.php";
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
    <title>Add Doctor Result Page</title>
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