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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"  "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Add Doctor Page</title>
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
                              action="AddDoctorControl.php"
                              onsubmit="return validateAddDoctorForm();"
                              enctype="application/x-www-form-urlencoded">
                            <tr>
                                <td colspan="2" class="center-label-td">Hospital Appointment System</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input class="textbox borderless" type="text"
                                           name="txt_name" id="txt_name"
                                           onchange="return validateData(this.id);"
                                           placeholder="Name" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input class="textbox borderless" type="text"
                                           name="txt_surname" id="txt_surname"
                                           onchange="return validateData(this.id);"
                                           placeholder="Surname" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">

                                    <select class="combobox borderless"
                                            name="cmb_branches" id="cmb_branches">
                                        <option selected disabled value="-1">Select a branch</option>
                                        <?php

                                        $conn = new mysqli($serverName, $username, $password, $database);

                                        if ($conn->connect_error)
                                        {
                                            echo "Connection failed: " . $conn->connect_error;
                                        }
                                        else
                                        {
                                            $query = "SELECT id, branch FROM TBL_BRANCHES WHERE isdeleted = 0";
                                            $result = $conn->query($query);
                                            if ($result->num_rows > 0)
                                            {
                                                while($row = $result->fetch_assoc())
                                                {
                                                    echo "<option value=\"" . $row['id'] . "\">" . $row['branch'] . "</option>";
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 50%;">
                                    <input class="textbox borderless" type="number"
                                           name="txt_age" id="txt_age"
                                           placeholder="Age" min="0" max="255" />
                                </td>
                                <td style="width: 50%;">
                                    <select class="combobox borderless"
                                            name="cmb_gender"
                                            placeholder="Gender">
                                        <option value="Female">Female</option>
                                        <option value="Male">Male</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input class="btn" type="submit"
                                           name="btn_addDoctor"
                                           value="Add Doctor"/>
                                </td>
                            </tr>
                        </form>
                        <tr>
                            <td colspan="2">
                                <form action="AdminHomePage.php" method="post">
                                    <input class="btn" type="submit" value="Go Back"/>
                                </form>
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
                            <label id="lbl_name"></label>
                        </td>
                    </tr>
                    <tr>
                        <td class="comment">
                            <label id="lbl_surname"></label>
                        </td>
                    </tr>
                    <tr>
                        <td class="comment">
                            <label id="lbl_branches"></label>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
</body>
</html>
