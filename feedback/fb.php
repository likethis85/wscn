<?php
$conn = mysql_connect('localhost', 'root', 'admin');

mysql_select_db("wscn", $conn);

$title   = htmlspecialchars(trim($_POST['title']));
$message = htmlspecialchars(trim($_POST['message']));
$email   = htmlspecialchars(trim($_POST['email']));
$uid     = intval($_POST['uid']);

$message = $title . ' - ' . $message . ' - ' . $email;
$timestamp = time();

$sql = "INSERT INTO `feedback` (`uid`, `status`, `message`, `location`, `timestamp`) VALUES ('$uid', 0, '$message', 'user?type=feedback', $timestamp)";

mysql_query($sql);
mysql_close($conn);
