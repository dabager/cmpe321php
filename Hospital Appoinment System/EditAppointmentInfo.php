<?php
/**
 * @author : Umut M. Dabager <dabager@outlook.com>
 * Hospital Appointment System - Register Page
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

$branchID = @$_POST['cmb_branches'];
$_SESSION['branchID'] = $branchID;

$conn = new mysqli($serverName, $username, $password, $database);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"  "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Edit Appointment Information Page</title>
    <link rel="stylesheet" type="text/css" href="GlobalStyle.css" />
    <script type="text/javascript" src="GlobalScript.js"></script>
</head>
<body>
<div class="center-div" style="width: 850px; height: 450px; background: #484848;">
    <table width="100%" style="background: #484848;">
        <!--
        Main table for user input.
        This table has 3 columns, First one for horizontal spacing, second one for user input, third one for validation messages.
        -->
        <tr style="height: 450px;">
            <!--
            Spacing Column
            -->
            <td style="width: 300px; background: #484848" />
            <!--
            Main User Input Column
            -->
            <td>
                <div class="center-div" style="width: 250px; background: #333333;">
                    <table cellspacing="10" style="width: 200px;">
                        <form method="post"
                              action="EditAppointmentResult.php"
                              onsubmit="return validateMakeAppointmentForm();"
                              enctype="application/x-www-form-urlencoded">
                            <tr>
                                <td class="center-label-td">Hospital Appointment System</td>
                            </tr>
                            <tr>
                                <td>
                                    <select class="combobox borderless"
                                            name="cmb_doctors" id="cmb_doctors">
                                        <option selected disabled value="-1">Select a doctor</option>
                                        <?php

                                        $conn = new mysqli($serverName, $username, $password, $database);

                                        if ($conn->connect_error)
                                        {
                                            echo "Connection failed: " . $conn->connect_error;
                                        }
                                        else
                                        {
                                            $query = "SELECT id, CONCAT(CONCAT(name,' '),surname) AS doctor FROM TBL_DOCTORS WHERE isdeleted = 0 AND branch = " . $_SESSION['branchID'];
                                            $result = $conn->query($query);
                                            if ($result->num_rows > 0)
                                            {
                                                while($rowDoctor = $result->fetch_assoc())
                                                {
                                                    $selection = "";
                                                    if($rowDoctor['id'] === $_SESSION["selectedDoctorID"]) $selection = "selected=true ";
                                                    echo "<option ". $selection . " value=\"" . $rowDoctor['id'] . "\">" . $rowDoctor['doctor'] . "</option>";
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="datetime-local"
                                           class="textbox borderless"
                                           name="dtp_appointment" id="dtp_appointment"
                                           value="<?php echo date("Y-m-d\\TH:i:s", strtotime($_SESSION["selectedAppointmentDate"]));?>"
                                           onchange="return datetimeControl(this.id);"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input class="btn" type="submit" value="Next page" />
                                </td>
                            </tr>
                        </form>
                        <tr>
                            <td>
                                <a href='EditAppointment.php'>
                                    <input class="btn" type="submit" value="Go Back" />
                                </a>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
            <!--
            Validation Error Column
            -->
            <td style="width: 300px; background: #484848">

                <table cellspacing="10" style="width: 100%; margin-bottom:75px; background: #484848;">
                    <tr>
                        <td class="comment">
                            <label id="lbl_doctors"></label>
                        </td>
                    </tr>
                    <tr>
                        <td class="comment">
                            <label id="lbl_appointment"></label>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
</body>
</html>
