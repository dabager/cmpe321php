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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"  "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Add Branch Page</title>
        <link rel="stylesheet" type="text/css" href="GlobalStyle.css" />
        <script type="text/javascript" src="GlobalScript.js"></script>
    </head>
    <body>
        <div class="center-div" style="width: 850px; height: 500px; background: #484848;">
            <table width="100%" style="background: #484848;">
                <!--
                Main table for user input.
                This table has 3 columns, First one for horizontal spacing, second one for user input, third one for validation messages.
                -->
                <tr style="height: 350px;">
                    <!--
                    Spacing Column
                    -->
                    <td style="width: 300px; background: #484848" />
                    <!--
                    Main User Input Column
                    -->
                    <td>
                        <div class="center-div" style="width: 250px; height: 500px; background: #333333;">
                            <table cellspacing="10" style="width: 200px;">
                                <tr>
                                    <td class="center-label-td">Hospital Appointment System</td>
                                </tr>
                                <tr>
                                    <td class="center-label-td" style="font-weight: normal; font-size: 12px;">Welcome <?php echo $_SESSION["name"] . " " . $_SESSION["surname"] ?></td>
                                </tr>
                                <form method="post"
                                      action="AddBranchControl.php"
                                      onsubmit="return validateBranch('txt_branchname');"
                                      enctype="application/x-www-form-urlencoded">
                                    <tr>
                                        <td>
                                            <input class="textbox borderless" type="text"
                                                   name="txt_branchname" id="txt_branchname"
                                                   onchange="return validateData(this.id);"
                                                   placeholder="Enter a branch name" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href='AddBranch.php'>
                                                <input class="btn" type="submit" value="Add branch" />
                                            </a>
                                        </td>
                                    </tr>
                                </form>
                                <tr>
                                    <td>
                                        <a href='AdminHomePage.php'>
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
        
                        <table cellspacing="10" style="width: 100%; margin-bottom: 5px; background: #484848;">
                            <tr>
                                <td class="comment">
                                    <label id="lbl_branchname"></label>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>
