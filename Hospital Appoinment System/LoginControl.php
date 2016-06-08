<?php
/**
 * @author : Umut M. Dabager <dabager@outlook.com>
 * Hospital Appointment System
 * Written for the Cmpe 321 Assignment 3
 */

$serverName = "localhost";
$username = "root";
$password = "Sf86ucj7CZ";
$database = "hospital";

$conn = new mysqli($serverName, $username, $password, $database);

if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}
else
{
    $loginUsername =@$_POST['txt_username'];
    $loginPassword =@$_POST['txt_password'];
    
    $query = "SELECT FN_CHECK_USER('" . $loginUsername . "', '" . $loginPassword . "') AS userrole";
    $result = $conn->query($query);

    if ($result->num_rows > 0)
    {
        $row = $result->fetch_assoc();
        $userrole = $row["userrole"];

        if($userrole != "0")
        {
            session_start();
            $query = "CALL SP_RETRIEVE_USER_INFO('" . $loginUsername . "', '" . $loginPassword . "')";
            $result = $conn->query($query);

            if ($result->num_rows > 0)
            {
                $row = $result->fetch_assoc();
                $_SESSION["id"] = $row["id"];
                $_SESSION["name"] = $row["name"];
                $_SESSION["surname"] = $row["surname"];
                $_SESSION["age"] = $row["age"];
                $_SESSION["gender"] = $row["gender"];
            }
            $_SESSION["role"] = $userrole;
            $_SESSION["login"] = true;
            $redirectAddress = "";
            
            if($userrole === "1") $redirectAddress = "AdminHomePage";
            else if($userrole === "2") $redirectAddress = "PatientHomePage";
            session_write_close();
            header("Location: " . $redirectAddress . ".php");
            exit;
        }
    }
    else
    {
        echo "Record does not exist";
    }

}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"  "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Login Result Page</title>
        <link rel="stylesheet" type="text/css" href="GlobalStyle.css">
    </head>
    <body>
        <div class="center-div" style="width: 250px; height: 300px; background: #333333;">
            <table cellspacing="10" style="width: 200px;">
                <tr>
                    <td class="center-label-td">Hospital Appointment System</td>
                </tr>
                <tr>
                    <td class="center-label-td" style="font-weight: normal;">User not found or Username / Password is wrong.</td>
                </tr>
                <tr>
                    <td>
                        <a href='Login.php'>
                            <input class="btn" type="submit" name="btn_returnLogin" value="Return to Login Page"/>
                        </a>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>