# Drupal: ReadyStack build kit

The offline build kit for the Docker image `readystack/drupal:11.4.13-CE-ubuntu24.04-r2`. It holds what the image is built from (upstream source, base images, toolchain, pinned dependencies) and the documents, so the image can be rebuilt with no network access (`docker build --network=none`).

- Release: [11.4.13-CE-ubuntu24.04-r2](https://github.com/readystack-dev/drupal/releases/tag/11.4.13-CE-ubuntu24.04-r2)
- Image: [`docker.io/readystack/drupal:11.4.13-CE-ubuntu24.04-r2`](https://hub.docker.com/r/readystack/drupal/tags), manifest digest `sha256:4b781b0f1987b15518458619f18bab4c9d649a9cebd298634e937818f00a7b6b`
- Product page: https://readystack.dev/products/drupal
- Defects: this repository's Issues (defects recorded from 25 November 2026 on) and https://readystack.dev/defects.html?product=drupal

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
