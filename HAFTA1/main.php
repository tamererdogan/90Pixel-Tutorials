<?php
	//require __DIR__."vendor/autoload.php";
	require __DIR__ ."/vendor/autoload.php";
	//app'i autoload'a ekle
	require "App.php";

	$app = new App(3, 8);
	$app->baslat();
?>