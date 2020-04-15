<?php
	session_start();
	error_reporting(E_ALL);
	include("Validate.class.php");
	include("XTemplate.class.php");
	include("Model.class.php");
	include("app.class.php");
	$valid = new Validate;
	$baseUrl = "http://".$_SERVER['HTTP_HOST']."/eProject/";
	$dsn="mysql:host=localhost;port=3306;dbname=category";
	$usr = 'root';
	$pwd = '';
	$db = new Model($dsn,$usr,$pwd);
	$f = new app;
	