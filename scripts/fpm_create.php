#! /usr/bin/php
<?php
require_once "../vendor/autoload.php";
require_once "helpers.php";

$os_username = '';

if (empty($argv[1]) or empty($argv[2])) {
	print "Usage of this script requires that fpm linux user name and the desired php number version to be passed as first and secound parameter respestively.\n\n    $argv[0] [username] [version] \n";
	return 1;
}


$os_username = $argv[1];
$fpms_path = '/etc/php/' . $argv[2] . '/fpm/pool.d';
$fpm_filename = $os_username . '.conf';


if (!empty($argv[3])) {
	print "The name of the fpm conf file will be $argv[3] \n";
	$fpm_filename = $argv[3] . '.conf';
}


$fpm_full_filename = $fpms_path . '/' . $fpm_filename;
$template_file = 'fpm_general_template.twig';
if ($os_username == 'phpmyadmin') {
	$template_file = 'fpm_phpmyadmin_template.twig';
}


$loader = new \Twig\Loader\FilesystemLoader([
	'templates/addfpm'
]);

$twig = new \Twig\Environment($loader);

$template_vars = ['username' => $os_username];
$fpm_content = $twig->render($template_file, $template_vars);


file_put_contents($fpm_full_filename, $fpm_content );
print "A new fpm  file was created:\n$fpm_full_filename \n";



