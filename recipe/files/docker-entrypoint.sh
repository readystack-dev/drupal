#!/bin/sh
# ReadyStack Drupal entrypoint: first-start setup (hash salt, non-interactive install), then Apache in the foreground.
set -e
i=0
until php /usr/local/lib/readystack/drupal-first-start.php; do
  i=$((i+1))
  if [ "${DRUPAL_DB_DRIVER:-sqlite}" = sqlite ] || [ "$i" -ge 30 ]; then
    echo "drupal: first-start setup failed; not starting Apache" >&2
    exit 1
  fi
  echo "drupal: database not ready, retrying in 2s ($i/30)"
  sleep 2
done
exec apache2-foreground
