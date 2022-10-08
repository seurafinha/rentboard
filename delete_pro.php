<?php


include('database_connection.php');

session_start();

if(!isset($_SESSION['user_id']))
{
	header("location:login.php");
}
 

$gameId = $_GET['proid'];

// sending query
mysqli_query($connDb,"DELETE FROM products WHERE id = '$gameId'");

header("Location: games.php");



?>