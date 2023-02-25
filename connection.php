<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "todo_list";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname)) {
	die("failed to connect!");
}
