<?php
// ~/php/public/home.php

// include model
include __DIR__ . '/../model/home_twig.php';




require_once '../vendor/twig/twig/lib/Twig/Autoloader.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('../templates');
$engine = new Twig_Environment($loader);

$template = $engine->loadTemplate('home.twig');
echo $template->render(array(
	'markersJavascriptString' => $markersJavascriptString,
	'logoutLinkString' => $logoutLinkString,
	'loggedAsStatementString' => $loggedAsStatementString,
	'loginLinkString' => $loginLinkString
)); 



?>