# Drupal: ReadyStack build kit

The offline build kit for the Docker image `readystack/drupal:11.4.13-CE-ubuntu24.04-r2`. It holds what the image is built from (upstream source, base images, toolchain, pinned dependencies) and the documents, so the image can be rebuilt with no network access (`docker build --network=none`).

- Release: [11.4.13-CE-ubuntu24.04-r2](https://github.com/readystack-dev/drupal/releases/tag/11.4.13-CE-ubuntu24.04-r2)
- Image: [`docker.io/readystack/drupal:11.4.13-CE-ubuntu24.04-r2`](https://hub.docker.com/r/readystack/drupal/tags), manifest digest `sha256:4b781b0f1987b15518458619f18bab4c9d649a9cebd298634e937818f00a7b6b`
- Product page: https://readystack.dev/products/drupal
- Source and build recipe: https://readystack.dev/products/drupal/recipe
- Build trail: https://readystack.dev/products/drupal/trail/11.4.13-CE-ubuntu24.04-r2
- Defects: this repository's Issues (defects recorded from 25 November 2026 on) and https://readystack.dev/defects.html?product=drupal

## The image

A single container: Apache 2.4 with mod_php (Ubuntu 24.04's PHP 8.3) serving Drupal from /opt/drupal/web on port 8080, as the non-root www-data user. The default database is an embedded SQLite file, /var/lib/drupal/drupal.sqlite, so one container is the whole site; MySQL/MariaDB or PostgreSQL are supported through DRUPAL_DB_* variables. The site is installed at the first start (standard profile), before Apache starts, so the web installer is never served.

## Who uses Drupal and why

Government agencies, universities, media companies and other organisations that build content-rich websites.

Drupal is content management software for websites and applications built on structured content. Its core does a lot on its own and can be extended with free, open-source modules.

A typical use: A university needs department pages, event listings and staff profiles in one site. In Drupal editors fill in structured content, themes control how it is presented, and modules add features before anyone writes custom code.

From the upstream project's own description: https://github.com/drupal/drupal, https://www.drupal.org/about.

## This release

- Docker Scout policy grade at release: **A** (94%), graded 2026-11-25 with `docker scout policy` (CLI 1.26.0, docker-default configuration).
  - Docker Scout counts 143 packages with copyleft licences (GPL, LGPL, MPL), 138 of them operating-system packages (it counts only packages whose licence it can read; the SBOM lists every component).
- Signed with ReadyStack's release key (fingerprint `04daa92344a52dbc`): https://readystack.dev/keys/cosign.pub.
- Runs as a non-root user (`www-data`).
- Attestations on the image: an SPDX SBOM and SLSA provenance v1.
- Rebuilt from this kit with network egress blocked on 2026-11-24; the rebuilt image digest is the published one.
- Base: Ubuntu 24.04.

The current grade, measured again every day, is on https://readystack.dev/products/drupal.

Drupal is distributed under its upstream licence (GPL-2.0-or-later); the kit contains upstream's source under that licence, and each vendored component under its own.

## Download

From the [11.4.13-CE-ubuntu24.04-r2 release](https://github.com/readystack-dev/drupal/releases/tag/11.4.13-CE-ubuntu24.04-r2): `ReadyStack-drupal-11.4.13-CE-ubuntu24.04-r2.tar.gz` (192.8 MB), SHA-256 `4b2604f00bd2f7d2a85deff85008c5e77dc57b0e39b46ec875a4ecdded87168f`.

```sh
sha256sum --check --ignore-missing SHA256SUMS
```

## Verify and rebuild

The rebuild statement is signed with the ReadyStack release key. Check the signature before you rely on it:

```sh
cosign verify-blob --key https://readystack.dev/keys/cosign.pub \
  --bundle ReadyStack-drupal-11.4.13-CE-ubuntu24.04-r2.rebuild.json.sigstore ReadyStack-drupal-11.4.13-CE-ubuntu24.04-r2.rebuild.json
```

Unpack with `-p` so file modes are kept, then follow the kit's own README.md and docs/REBUILD.md:

```sh
tar -xpzf ReadyStack-drupal-11.4.13-CE-ubuntu24.04-r2.tar.gz
cd 11.4.13-CE-ubuntu24.04-r2
less README.md docs/REBUILD.md
```

The build trail (`ReadyStack-drupal-11.4.13-CE-ubuntu24.04-r2.trail.json`, signed the same way, and its Markdown copy) records how this release was built and checked.

## This repository

`recipe/` holds the kit's recipe files (Dockerfiles, build scripts, pins) as published at https://readystack.dev/products/drupal/recipe. The complete kit is the release download. Each release is a tag here.

— ReadyStack · https://readystack.dev
