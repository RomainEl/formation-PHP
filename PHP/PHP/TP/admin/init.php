<?php
session_start();

$base = new PDO('mysql:host=localhost;dbname=tf2',
	 'root',
	 '',
	 array(
		   PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
		   PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
	 ));

define('ROOT_SITE','/formation-PHP/PHP/PHP/TP/');