[![ReadyStack](https://readystack.dev/logo.svg)](https://readystack.dev)

**Stable, Open-source Releases, Automated** · [readystack.dev](https://readystack.dev)

[![Docker Hub](https://img.shields.io/badge/Docker%20Hub-readystack%2Fdrupal-2496ED?logo=docker&logoColor=white)](https://hub.docker.com/r/readystack/drupal) [![Docker pulls](https://img.shields.io/docker/pulls/readystack/drupal)](https://hub.docker.com/r/readystack/drupal) [![Grade at release](https://img.shields.io/badge/grade%20at%20release-A%20%2894%25%29-2ea44f)](https://readystack.dev/products/drupal) [![Signed: cosign](https://img.shields.io/badge/signed-cosign-2ea44f)](https://readystack.dev/keys/cosign.pub) ![SBOM: SPDX](https://img.shields.io/badge/SBOM-SPDX-2ea44f) ![Provenance: SLSA v1](https://img.shields.io/badge/provenance-SLSA%20v1-2ea44f) ![Offline rebuild: verified](https://img.shields.io/badge/offline%20rebuild-verified-2ea44f)

# Drupal: ReadyStack build kit

The offline build kit for the Docker image `readystack/drupal:11.4.14-CE-ubuntu24.04-r1`. It holds what the image is built from (upstream source, base images, toolchain, pinned dependencies) and the documents, so the image can be rebuilt with no network access (`docker build --network=none`).

- Release: [11.4.14-CE-ubuntu24.04-r1](https://github.com/readystack-dev/drupal/releases/tag/11.4.14-CE-ubuntu24.04-r1)
- Image: [`docker.io/readystack/drupal:11.4.14-CE-ubuntu24.04-r1`](https://hub.docker.com/r/readystack/drupal/tags), manifest digest `sha256:b0922a4ab3f956ff1d4952a7397e4499c33dff70e15021122af866d7dbfa61a5`
- Product page: https://readystack.dev/products/drupal
- Source and build recipe: https://readystack.dev/products/drupal/recipe
- Build trail: https://readystack.dev/products/drupal/trail/11.4.14-CE-ubuntu24.04-r1
- Defects: this repository's Issues (defects recorded from 25 November 2026 on) and https://readystack.dev/defects.html?product=drupal

## The image

A single container: Apache 2.4 with mod_php (Ubuntu 24.04's PHP 8.3) serving Drupal from /opt/drupal/web on port 8080, as the non-root www-data user. The default database is an embedded SQLite file, /var/lib/drupal/drupal.sqlite, so one container is the whole site; MySQL/MariaDB or PostgreSQL are supported through DRUPAL_DB_* variables. The site is installed at the first start (standard profile), before Apache starts, so the web installer is never served.

## Who uses Drupal and why

Government agencies, universities, media companies and other organisations that build content-rich websites.

Drupal is content management software for websites and applications built on structured content. Its core does a lot on its own and can be extended with free, open-source modules.

A typical use: A university needs department pages, event listings and staff profiles in one site. In Drupal editors fill in structured content, themes control how it is presented, and modules add features before anyone writes custom code.

From the upstream project's own description: https://github.com/drupal/drupal, https://www.drupal.org/about.

## This release

- Docker Scout policy grade at release: **A** (94%), graded 2026-11-28 with `docker scout policy` (CLI 1.26.0, docker-default configuration).
  - Docker Scout counts 143 packages with copyleft licences (GPL, LGPL, MPL), 138 of them operating-system packages (it counts only packages whose licence it can read; the SBOM lists every component).
- Signed with ReadyStack's release key (fingerprint `04daa92344a52dbc`): https://readystack.dev/keys/cosign.pub.
- Runs as a non-root user (`www-data`).
- Attestations on the image: an SPDX SBOM and SLSA provenance v1.
- Rebuilt from this kit with network egress blocked on 2026-11-28; the rebuilt image digest is the published one.
- Base: Ubuntu 24.04.

The current grade, measured again every day, is on https://readystack.dev/products/drupal.

Drupal is distributed under its upstream licence (GPL-2.0-or-later); the kit contains upstream's source under that licence, and each vendored component under its own.

## Download

From the [11.4.14-CE-ubuntu24.04-r1 release](https://github.com/readystack-dev/drupal/releases/tag/11.4.14-CE-ubuntu24.04-r1): `ReadyStack-drupal-11.4.14-CE-ubuntu24.04-r1.tar.gz` (192.9 MB), SHA-256 `197ef3854ebb9052462b0479a5af9ad998970f7cb8c9d91fa85f6213effee872`.

```sh
sha256sum --check --ignore-missing SHA256SUMS
```

## Verify and rebuild

The rebuild statement is signed with the ReadyStack release key. Check the signature before you rely on it:

```sh
cosign verify-blob --key https://readystack.dev/keys/cosign.pub \
  --bundle ReadyStack-drupal-11.4.14-CE-ubuntu24.04-r1.rebuild.json.sigstore ReadyStack-drupal-11.4.14-CE-ubuntu24.04-r1.rebuild.json
```

Unpack with `-p` so file modes are kept, then follow the kit's own README.md and docs/REBUILD.md:

```sh
tar -xpzf ReadyStack-drupal-11.4.14-CE-ubuntu24.04-r1.tar.gz
cd 11.4.14-CE-ubuntu24.04-r1
less README.md docs/REBUILD.md
```

The build trail (`ReadyStack-drupal-11.4.14-CE-ubuntu24.04-r1.trail.json`, signed the same way, and its Markdown copy) records how this release was built and checked.

## This repository

`recipe/` holds the kit's recipe files (Dockerfiles, build scripts, pins) as published at https://readystack.dev/products/drupal/recipe. The complete kit is the release download. Each release is a tag here. How to report a vulnerability: [SECURITY.md](SECURITY.md).

## About ReadyStack

**Stable, Open-source Releases, Automated.** ReadyStack releases popular open-source apps every week with every available critical and high security fix applied, plus full documentation, reference data, tests and a build recipe that recreates each release bit-for-bit. Each release is rebuilt from its pinned inputs with the network off, checked against its published digest, signed, and scanned and graded again every day. The images and build kits are free, and ReadyStack is soon to be a nonprofit.

[readystack.dev](https://readystack.dev) · [All products](https://readystack.dev/products.html) · [Build kits on GitHub](https://github.com/readystack-dev) · [Defect log](https://readystack.dev/defects.html) · contact@readystack.dev

— ReadyStack · https://readystack.dev
