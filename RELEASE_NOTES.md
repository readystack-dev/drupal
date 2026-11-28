# Drupal 11.4.14 — ReadyStack release `11.4.14-CE-ubuntu24.04-r1`

Generated 2026-11-28 from this release's build records and strategy. Statements that come from a single record name it in brackets; the others come from this release's strategy and build log.

## Release

- **Image:** `readystack/drupal:11.4.14-CE-ubuntu24.04-r1` (linux/amd64). Index digest `sha256:f460965a10e8597a1480736e59fa659181c9978bf4210d88428226b86925b248` [`docs/provenance/LOCKED_DIGEST.txt`].
- **Image manifest digest:** `sha256:b0922a4ab3f956ff1d4952a7397e4499c33dff70e15021122af866d7dbfa61a5` [`TARGET_DIGEST.txt`].
- **Upstream:** Drupal 11.4.14 built from source at `11.4.14` of https://github.com/drupal/recommended-project — upstream notes: https://github.com/drupal/recommended-project/releases/tag/11.4.14 [`docs/provenance/BUILD_RECIPE.json`].
- **Base image:** `ubuntu:24.04`; runtime user `www-data`.
- **Build:** `source-rebuild-php`, built offline with `--network=none`.
- **Supersedes:** ReadyStack release `11.4.13-CE-ubuntu24.04-r2`.

## What changed in this release

- Upstream version 11.4.13 → 11.4.14.
- This release moves Drupal from 11.4.13 to 11.4.14, a newer release of upstream's 11.4.x line. Upstream's release notes list what changed: https://github.com/drupal/recommended-project/releases/tag/11.4.14

## Security status at release (measured 2026-11-28)

- **Docker Scout:** 0 fixable critical/high vulnerabilities; runs as `www-data` (non-root); SBOM + provenance attestations present (SPDX SBOM + SLSA v1) [`docs/provenance/SCOUT_VERDICT.json`].
- **OSV cross-check:** no fixable critical/high vulnerability beyond Docker Scout's findings.
- **Signature:** cosign signature verified by ReadyStack's release gate before publishing; check it yourself with `cosign verify --key https://readystack.dev/keys/cosign.pub readystack/drupal:11.4.14-CE-ubuntu24.04-r1` (signatures are recorded in the public Sigstore transparency log).
- **ReadyStack release check at release:** passed (ReadyStack's own test, not a Docker Scout grade). Vulnerabilities are disclosed every day and the image never changes, so it is re-checked daily, beside Docker Scout's own dated grade, at https://readystack.dev/queue.
- **Before exposing this service:** Set DRUPAL_TRUSTED_HOSTS to the host names the site is reached by; without it Drupal accepts any Host header (its status report flags this) and generated links can point at a host an attacker chose.
- **Before exposing this service:** Port 8080 is plain HTTP: put a TLS-terminating reverse proxy in front and set DRUPAL_REVERSE_PROXY_ADDRESSES to its address.

## Reproducibility

Rebuilds offline from this archive to the identical image digest `sha256:b0922a4ab3f956ff1d4952a7397e4499c33dff70e15021122af866d7dbfa61a5`: run `./BUILD_OFFLINE.sh`, then `./VERIFY_OFFLINE.sh` (add `--online` to confirm the Docker Hub tag holds the same digest). Before publishing, ReadyStack rebuilt the kit with `./BUILD_OFFLINE.sh` and compared the result with the published digest [`docs/provenance/REPRO_VERIFICATION.json`], then ran `./BUILD_OFFLINE.sh` and `./VERIFY_OFFLINE.sh` from this archive (without `--online`).

## Validation

- 4 of 4 use cases passed (6 authored, 4 kept in the suite; 2 not exercised, see below) against the running image [`docs/validation/test-results.json`].
- 2 further authored checks were not exercised and are not counted above: 1 needed credentials the build's check does not have; 1 expected HTTP 200 from `/core/install.php`, which this image refuses to everyone with HTTP 403 by design (listed under Not exercised in `docs/validation/FAILED_TESTS.md`).

## Known issues

- None found (reviewed by held semantic review (Claude) on 2026-11-28).

## Verify this archive

```
sha256sum -c CHECKSUMS.sha256
./BUILD_OFFLINE.sh && ./VERIFY_OFFLINE.sh --online
cosign verify --key https://readystack.dev/keys/cosign.pub readystack/drupal:11.4.14-CE-ubuntu24.04-r1
```

ReadyStack records every signature in the public Sigstore transparency log (Rekor), so the command needs no extra flags.

