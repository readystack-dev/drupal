<?php

/**
 * ReadyStack: set a Drupal user's password, read from standard input (never from the command line).
 *   printf '%s\n' 'new-password' | docker exec -i drupal php /usr/local/lib/readystack/drupal-set-password.php [user]
 * The user name defaults to admin. Runs as www-data inside the container.
 */

use Drupal\Core\DrupalKernel;
use Symfony\Component\HttpFoundation\Request;

if (PHP_SAPI !== 'cli') {
  exit(1);
}
$name = $argv[1] ?? 'admin';
$pass = rtrim((string) stream_get_contents(STDIN), "\r\n");
if ($pass === '') {
  fwrite(STDERR, "usage: printf '%s\\n' 'new-password' | php " . $argv[0] . " [user]\n");
  exit(1);
}
chdir('/opt/drupal/web');
$class_loader = require 'autoload.php';
$request = Request::create('/', 'GET', [], [], [], [
  'HTTP_HOST' => 'localhost',
  'SCRIPT_NAME' => '/index.php',
  'SCRIPT_FILENAME' => '/opt/drupal/web/index.php',
]);
$kernel = DrupalKernel::createFromRequest($request, $class_loader, 'prod');
$kernel->boot();
$kernel->preHandle($request);
$accounts = \Drupal::entityTypeManager()->getStorage('user')->loadByProperties(['name' => $name]);
$account = reset($accounts);
if (!$account) {
  fwrite(STDERR, "drupal: no user named $name\n");
  exit(1);
}
$account->setPassword($pass);
$account->save();
echo "drupal: password changed for $name\n";
