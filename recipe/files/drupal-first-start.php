<?php

/**
 * ReadyStack first start, run by the entrypoint as www-data before Apache starts:
 *  1. creates /var/lib/drupal's directories and this instance's hash salt (once, mode 600);
 *  2. when the database holds no Drupal yet, installs the site with Drupal's own installer, install_drupal(), the
 *     function core/install.php runs, with the values from the environment, so the web installer is never needed
 *     (and the image never serves it).
 * Exit 0: installed (now or before). 2: the database cannot be reached (the entrypoint retries a server database).
 */

use Drupal\Component\Utility\Crypt;
use Drupal\Core\Database\Database;
use Drupal\Core\DrupalKernel;
use Drupal\Core\Site\Settings;

if (PHP_SAPI !== 'cli') {
  exit(1);
}
$data = '/var/lib/drupal';
foreach ([$data, "$data/config/sync", "$data/private"] as $dir) {
  if (!is_dir($dir) && !@mkdir($dir, 0770, TRUE)) {
    fwrite(STDERR, "drupal: cannot create $dir - /var/lib/drupal must be writable by www-data (uid 33)\n");
    exit(1);
  }
}
chdir('/opt/drupal/web');
$class_loader = require 'autoload.php';

$salt = "$data/hash_salt";
if (!is_file($salt) || filesize($salt) === 0) {
  $umask = umask(077);
  $ok = file_put_contents("$salt.tmp", Crypt::randomBytesBase64(55)) !== FALSE && rename("$salt.tmp", $salt);
  umask($umask);
  if (!$ok) {
    fwrite(STDERR, "drupal: cannot write $salt\n");
    exit(1);
  }
  echo "drupal: generated this instance's hash salt into $salt\n";
}

DrupalKernel::bootEnvironment();
Settings::initialize(getcwd(), 'sites/default', $class_loader);
try {
  $installed = Database::getConnection()->schema()->tableExists('key_value');
}
catch (\Throwable $e) {
  fwrite(STDERR, 'drupal: cannot reach the database: ' . $e->getMessage() . "\n");
  exit(2);
}
if ($installed) {
  echo "drupal: the site is installed\n";
  exit(0);
}

$env = static function (string $name, string $default = ''): string {
  $value = getenv($name);
  return ($value === FALSE || $value === '') ? $default : $value;
};
$user = $env('DRUPAL_ADMIN_USER', 'admin');
$mail = $env('DRUPAL_ADMIN_EMAIL', 'admin@example.com');
$pass = $env('DRUPAL_ADMIN_PASSWORD');
if (trim($pass) === '') {
  $pass = Crypt::randomBytesBase64(18);
  $umask = umask(077);
  file_put_contents("$data/initial_admin_password", $pass . "\n");
  umask($umask);
  echo "drupal: DRUPAL_ADMIN_PASSWORD is not set - generated the administrator password into $data/initial_admin_password\n";
}

require_once 'core/includes/install.core.inc';
install_drupal($class_loader, [
  'interactive' => FALSE,
  'site_path' => 'sites/default',
  'parameters' => [
    'profile' => $env('DRUPAL_PROFILE', 'standard'),
    'langcode' => 'en',
  ],
  'forms' => [
    'install_configure_form' => [
      'site_name' => $env('DRUPAL_SITE_NAME', 'Drupal'),
      'site_mail' => $env('DRUPAL_SITE_MAIL', $mail),
      'account' => [
        'name' => $user,
        'mail' => $mail,
        'pass' => ['pass1' => $pass, 'pass2' => $pass],
      ],
      'enable_update_status_module' => TRUE,
      'enable_update_status_emails' => NULL,
    ],
  ],
]);
echo "drupal: installed the site (profile " . $env('DRUPAL_PROFILE', 'standard') . ", administrator $user)\n";
exit(0);
