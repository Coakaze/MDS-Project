<?php

define('DB_NAME', 'hotel');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');

$db = new mysqli('DB_HOST', 'DB_USER', 'DB_PASSWORD', 'DB_NAME');
if($db -> connect_error) {
	die("Connection failed" . $db -> connect_error);
}