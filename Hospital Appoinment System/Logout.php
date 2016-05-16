<?php
/**
 * @author : Umut M. Dabager <dabager@outlook.com>
 * Hospital Appointment System - Login Page
 * Written for the Cmpe 321 Assignment 3
 */
session_start();
session_destroy();
session_write_close();
header("Location: Login.php");
exit;