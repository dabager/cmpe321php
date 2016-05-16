<?php
/**
 * @author : Umut M. Dabager <dabager@outlook.com>
 * Hospital Appointment System - Register Result Page
 * Written for the Cmpe 321 Assignment 3
 */

session_start();

$regUsername =@$_POST['txt_username'];
$regPassword =@$_POST['txt_password'];
$regName =@$_POST['txt_name'];
$regSurname =@$_POST['txt_surname'];
$regAge =@$_POST['txt_age'];
$regGender =@$_POST['cmb_gender'];

$serverName = "localhost";
$username = "root";
$password = "Sf86ucj7CZ";
$database = "hospital";

$conn = new mysqli($serverName, $username, $password, $database);
$message = "";
$redirectURL = "";

if ($conn->connect_error)
{
    $message = "Connection failed: " . $conn->connect_error;
    $redirectURL = "Register.php";
}
else
{
    $query = "SELECT COUNT(*) AS count FROM TBL_USERS WHERE isdeleted = 0 AND username = '" . $regUsername . "'";
    $result = $conn->query($query);
    if ($result->num_rows > 0)
    {
        $row = $result->fetch_assoc();
        $count = $row["count"];

        if($count === "0")
        {
            $query = "INSERT INTO TBL_USERS (username,password,name,surname,age,gender) VALUES ('" .
                $regUsername . "', '" .
                $regPassword . "', '" .
                $regName . "', '" .
                $regSurname . "', " .
                $regAge . ", '" .
                $regGender . "')";

            if ($conn->query($query) === TRUE)
            {
                $message = "User created successfully.";
                $redirectURL = "Login.php";
            }
            else
            {
                $message =  "Record cannot created! Error : " . $conn->error;
                $redirectURL = "Register.php";
            }
        }
        else
        {
            $message = "Username already exists! Try again.";
            $redirectURL = "Register.php";
        }
    }
    else
    {
        $message =  "Error : " . $conn->error;
        $redirectURL = "Register.php";
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
        <title>Register Result Page</title>
        <link rel="stylesheet" type="text/css" href="GlobalStyle.css">
    </head>
    <body>
        <div class="center-div" style="width: 250px; height: 300px; background: #333333;">
            <table cellspacing="10" style="width: 200px;">
                <tr>
                    <td class="center-label-td">Hospital Appointment System</td>
                </tr>
                <tr>
                    <td class="center-label-td" style="font-weight: normal;"><?php echo $_SESSION["message"]?></td>
                </tr>
                <tr>
                    <td>
                        <a href='<?php echo $_SESSION["redirectURL"]?>'>
                            <input class="btn" type="submit" value="Go Back" />
                        </a>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>