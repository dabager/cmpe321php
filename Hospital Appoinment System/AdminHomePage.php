<?php
/**
 * @author : Umut M. Dabager <dabager@outlook.com>
 * Hospital Appointment System - Login Page
 * Written for the Cmpe 321 Assignment 3
 */
session_start();
if (!(isset($_SESSION['login']) && $_SESSION['login'] === true))
{
    header ("Location: UnauthorizedAccess.php");
    exit();
}
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Administrator Home Page</title>
        <link rel="stylesheet" type="text/css" href="GlobalStyle.css" />
        <script type="text/javascript" src="GlobalScript.js"></script>
    </head>
    <body>
        <div class="center-div" style="width: 250px; height: 500px; background: #333333;">
            <table cellspacing="10" style="width: 200px;">
                <tr>
                    <td class="center-label-td">Hospital Appointment System</td>
                </tr>
                <tr>
                    <td class="center-label-td" style="font-weight: normal; font-size: 12px;">Welcome <?php echo $_SESSION["name"] . " " . $_SESSION["surname"] ?></td>
                </tr>
                <tr>
                    <td>
                        <a href='AddBranch.php'>
                            <input class="btn" type="submit" value="Add branch" />
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href='EditBranch.php'>
                            <input class="btn" type="submit" value="Edit branch" />
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href='RemoveBranch.php'>
                            <input class="btn" type="submit" value="Remove branch" />
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href='AddDoctor.php'>
                            <input class="btn" type="submit" value="Add doctor" />
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href='EditDoctor.php'>
                            <input class="btn" type="submit" value="Edit doctor" />
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href='RemoveDoctor.php'>
                            <input class="btn" type="submit" value="Remove doctor" />
                        </a>
                    </td>
                </tr>

                <tr></tr>

                <tr>
                    <td>
                        <a href='Reports.php'>
                            <input class="btn" type="submit" value="View Reports" />
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href='Logout.php'>
                            <input class="btn" type="submit" value="Logout" />
                        </a>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>
