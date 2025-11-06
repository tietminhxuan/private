<?php
$hostname = "localhost";
$username = "root";
$password = "";
$databasename = "chiasetailieu";
$visitorTimeout = 900;
$MAXPAGE= 10;
$multiLanguage = 1;//0: single; 1 multi
$arrLanguage = array(
    array('vn', 'Viet Nam'),
    array('en', 'English')
);
$conn = mysqli_connect($hostname, $username, $password) or
    die("Không thể kết nối với csdl!");
mysqli_select_db($conn, $databasename);
mysqli_query($conn, "SET NAMES 'utf8'");
?>
