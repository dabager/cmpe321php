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
    $redirectURL = "DeleteBranch.php";
}
else
{
    $branchValue = @$_POST['cmb_branches'];
    
    if($branchValue === NULL)
    {
        $message =  "Please choose a branch to delete!";
        $redirectURL = "DeleteBranch.php";
    }
    else
    {
        $query = "UPDATE TBL_BRANCHES SET isdeleted = 1 WHERE id = " . $branchValue;

        if ($conn->query($query) === TRUE)
        {
            $message = "Branch deleted successfully.";
            $redirectURL = "AdminHomePage.php";
        }
        else
        {
            $message =  "Delete failed! Error : " . $conn->error;
            $redirectURL = "DeleteBranch.php";
        }
    }

    $_SESSION["message"] = $message;
    $_SESSION["redirectURL"] = $redirectURL;
}
$conn->close();
?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Edit Branch Result Page</title>
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