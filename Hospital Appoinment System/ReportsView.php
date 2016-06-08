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

$selectedBranch = @$_POST['cmb_branches'];
$selectedReport = @$_POST['cmb_reports'];
$reportName = "";

if($selectedReport == 0)
{
    $query = "CALL SP_PAST_APPOINTMENTS(" . $selectedBranch . ")";
    $reportName = "Past Appointments";
}
else
{
    $query = "CALL SP_FUTURE_APPOINTMENTS(" . $selectedBranch . ")";
    $reportName = "Future Appointments";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"  "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;"/>
    <title>Edit Doctor Result Page</title>
    <link rel="stylesheet" type="text/css" href="GlobalStyle.css">
</head>
<body style="background: #333333;">
<div class="center-div" style="width: 800px; height: 300px; background: #333333;">
    <table cellspacing="10" style="width: 800px;">
        <tr>
            <td class="center-label-td">Hospital Appointment System <br/> <?php echo $reportName; ?></td>
        </tr>
        <tr>
            <td class="center-label-td" style="font-weight: normal;">
                <?php
                $conn = new mysqli($serverName, $username, $password, $database);

                if ($conn->connect_error)
                {
                    echo "Connection failed: " . $conn->connect_error;
                }
                else
                {
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        ?>
                        <table border=1>
                            <tr>
                                <th>Date</th>
                                <th>Patient</th>
                                <th>Branch</th>
                                <th>Doctor</th>
                            </tr>
                            <?php

                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td class="td-result" style="width: 150px;"><?php echo $row["date"]; ?></td>
                                    <td class="td-result" style="width: 250px;"><?php echo $row["patient"]; ?></td>
                                    <td class="td-result" style="width: 150px;"><?php echo $row["branch"]; ?></td>
                                    <td class="td-result" style="width: 250px;"><?php echo $row["doctor"]; ?></td>
                                </tr>
                                <?php
                            }

                            ?>
                        </table>
                        <?php
                    }
                    $conn->close();
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <a href='Reports.php'>
                    <input class="btn" type="submit" value="Go Back" style="width: 150px;"/>
                </a>
            </td>
        </tr>
    </table>
</div>
</body>
</html>