#! /usr/bin/php
<?php
require_once "../vendor/autoload.php";
require_once "helpers.php";



if (empty($argv[1]) or empty($argv[2]) or empty($argv[3])) {
	print "Usage:\n
\$   $argv[0] [domain-name]* [/public/server/filepath]* [fpm-unit-name]* [fpm-unit-template-filename] \n\nParams with ( * ) are mandatory\n
Usage of this script requires the domain name, the full path to the public directory and the name of the php fpm unit to be passed as parameter in the mentioning order, Aditioanlly you may pass the name of a desired template file from templates folder but its not mandatory. \n\n";
	return 1;
}



$domain_name = $argv[1];
$public_path = $argv[2];
$fpm_name = $argv[3];


$loader = new \Twig\Loader\FilesystemLoader([s
	'templates/addngserver/'
]);

$twig = new \Twig\Environment($loader);
$template_vars = [
	'domain_name' => $domain_name,
	'public_path' => $public_path,
	'fpm_name' => $fpm_name
];


$template_filename = 'generic_php_server_template.twig';
if (str_contains($domain_name, 'phpmyadmin')   ){
	print "The phpmyadmin word was detected at domain name, phpmyadmin unit template will be used\n";
	$template_filename = 'phpmyadmin_server_template.twig';
}

if (!empty($argv[4]) ){
	print "A phpmyadmin server unit template will be used\n";
	$template_filename = $argv[4].'twig' ;	
}

$server_full_filename =  '/etc/nginx/sites-enabled/'.$domain_name;
$server_content = $twig->render($template_filename, $template_vars);

file_put_contents($server_full_filename, $server_content );
print "A server file was created:\n$server_full_filename \n";


