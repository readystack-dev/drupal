<?php

/**
 * ReadyStack Drupal settings. This file is part of the image (read-only): every value that differs per site comes
 * from the container's environment or from /var/lib/drupal, the data volume, so nothing here is edited at run time.
 * Upstream's defaults (default.settings.php, installed by drupal/core-composer-scaffold) are loaded first.
 */
require __DIR__ . '/default.settings.php';

/**
 * Database: the embedded SQLite file /var/lib/drupal/drupal.sqlite by default, or MySQL/MariaDB or PostgreSQL when
 * DRUPAL_DB_DRIVER is mysql or pgsql (DRUPAL_DB_HOST, DRUPAL_DB_PORT, DRUPAL_DB_NAME, DRUPAL_DB_USER,
 * DRUPAL_DB_PASSWORD). Read on every request, so a changed password needs only a recreated container.
 */
$readystack_env = static function (string $name, string $default = ''): string {
  $value = getenv($name);
  return ($value === FALSE || $value === '') ? $default : $value;
};
$readystack_driver = $readystack_env('DRUPAL_DB_DRIVER', 'sqlite');
if ($readystack_driver === 'sqlite') {
  $databases['default']['default'] = [
    'driver' => 'sqlite',
    'database' => $readystack_env('DRUPAL_DB_PATH', '/var/lib/drupal/drupal.sqlite'),
    'namespace' => 'Drupal\\sqlite\\Driver\\Database\\sqlite',
    'autoload' => 'core/modules/sqlite/src/Driver/Database/sqlite/',
  ];
}
elseif (in_array($readystack_driver, ['mysql', 'pgsql'], TRUE)) {
  $databases['default']['default'] = [
    'driver' => $readystack_driver,
    'host' => $readystack_env('DRUPAL_DB_HOST', 'localhost'),
    'port' => $readystack_env('DRUPAL_DB_PORT', $readystack_driver === 'pgsql' ? '5432' : '3306'),
    'database' => $readystack_env('DRUPAL_DB_NAME', 'drupal'),
    'username' => $readystack_env('DRUPAL_DB_USER', 'drupal'),
    'password' => $readystack_env('DRUPAL_DB_PASSWORD'),
    'prefix' => '',
    'namespace' => "Drupal\\{$readystack_driver}\\Driver\\Database\\{$readystack_driver}",
    'autoload' => "core/modules/{$readystack_driver}/src/Driver/Database/{$readystack_driver}/",
  ];
}

// This instance's hash salt, generated once at the first start (mode 600). Changing it signs everyone out.
$settings['hash_salt'] = trim((string) @file_get_contents('/var/lib/drupal/hash_salt'));
$settings['config_sync_directory'] = '/var/lib/drupal/config/sync';
$settings['file_private_path'] = '/var/lib/drupal/private';

// Host names Drupal answers to (protection against HTTP Host header attacks): DRUPAL_TRUSTED_HOSTS, a comma-separated
// list of host names, plus localhost and 127.0.0.1 for the health check. Unset: Drupal's default (any host), which
// its status report flags as an error.
$readystack_hosts = array_filter(array_map('trim', explode(',', $readystack_env('DRUPAL_TRUSTED_HOSTS'))));
if ($readystack_hosts) {
  $settings['trusted_host_patterns'] = array_merge(['^localhost$', '^127\.0\.0\.1$'],
    array_map(static fn (string $host): string => '^' . preg_quote($host) . '$', $readystack_hosts));
}

// Behind a reverse proxy that sets X-Forwarded-For/-Proto: DRUPAL_REVERSE_PROXY_ADDRESSES, the proxy's addresses.
$readystack_proxies = array_filter(array_map('trim', explode(',', $readystack_env('DRUPAL_REVERSE_PROXY_ADDRESSES'))));
if ($readystack_proxies) {
  $settings['reverse_proxy'] = TRUE;
  $settings['reverse_proxy_addresses'] = $readystack_proxies;
}
unset($readystack_env, $readystack_driver, $readystack_hosts, $readystack_proxies);
