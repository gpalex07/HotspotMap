<?php


require_once '../vendor/twig/twig/lib/Twig/Autoloader.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('../templates');
$twig = new Twig_Environment($loader);

$template = $twig->loadTemplate('menu.html');
echo $template->render(array(
	'a_variable' => 'Twig rocks!!'
)); 
?>