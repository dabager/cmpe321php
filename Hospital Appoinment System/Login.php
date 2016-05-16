<?php
/**
 * @author : Umut M. Dabager <dabager@outlook.com>
 * Hospital Appointment System - Login Page
 * Written for the Cmpe 321 Assignment 3
 */
session_start();
session_destroy();
session_write_close();
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Login Page</title>
        <link rel="stylesheet" type="text/css" href="GlobalStyle.css" />
        <script type="text/javascript" src="GlobalScript.js"></script>
    </head>
    <body>
        <div class="center-div" style="width: 850px; height: 350px; background: #484848;">
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
                        <div class="center-div" style="width: 250px; height: 350px; background: #333333;">
                            <table cellspacing="10" style="width: 200px;">
                                <tr>
                                    <td class="center-label-td">Hospital Appointment System</td>
                                </tr>
                                <form method="post"
                                      action="LoginControl.php"
                                      onsubmit="return validateLoginForm();"
                                      enctype="application/x-www-form-urlencoded">
                                    <tr>
                                        <td>
                                            <input class="textbox borderless" type="text"
                                                   name="txt_username" id="txt_username"
                                                   value="dabager"
                                                   onchange="return validateData(this.id);"
                                                   placeholder="Username" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input class="textbox borderless" type="password"
                                                   name="txt_password" id="txt_password"
                                                   value="pwadmin123"
                                                   onchange="return validateData(this.id);"
                                                   placeholder="Password" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input class="btn" type="submit" value="Login" />
                                        </td>
                                    </tr>
                                </form>
                                <tr>
                                    <td>
                                        <form action="Register.php" method="post" style="height: 30px;">
                                            <input class="btn" type="submit" value="Register"/>
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
        
                        <table cellspacing="10" style="width: 100%; margin-bottom:30px; background: #484848;">
                            <tr>
                                <td class="comment">
                                    <label id="lbl_username"></label>
                                </td>
                            </tr>
                            <tr>
                                <td class="comment">
                                    <label id="lbl_password"></label>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>
