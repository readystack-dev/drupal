# Provenance — Drupal (`11.4.13-CE-ubuntu24.04-r2`)

Every item below is copied from a record in this archive; the record is named in brackets.

## Source

- Upstream repository: https://github.com/drupal/recommended-project
- Revision built: `11.4.13` (commit `4e9b266a6d0dc3c91952365c74bb31dfb0ab0a1c`)
- Source tree: `e44288fed4cc8f7380266fa9f98c765a4dba7a944569bb7116f16c55cafb83bb` over 3 files [`docs/provenance/SOURCE_TREE_HASH.json`]
- Community Edition only: enterprise code is removed or refused before the build (CE audit at acquire).

## Build

- Method: `source-rebuild-php`; base image `ubuntu:24.04`
- Built with `--network=none` from vendored source, dependencies and base images; BuildKit pinned to `moby/buildkit:v0.31.2` (shipped in `toolchain/`).
- SOURCE_DATE_EPOCH: `1795543178` [`SOURCE_DATE_EPOCH.txt`]
- Frozen inputs: [`docs/provenance/FREEZE_MANIFEST.json`], build recipe: [`docs/provenance/BUILD_RECIPE.json`].

## Output

- Published image: `readystack/drupal:11.4.13-CE-ubuntu24.04-r2` — index digest `sha256:a0e313acb42febc99f51ce33c9eada7adad88def2ca41aecd1ae629eb80fd0b8` [`docs/provenance/LOCKED_DIGEST.txt`]
- linux/amd64 image digest `sha256:4b781b0f1987b15518458619f18bab4c9d649a9cebd298634e937818f00a7b6b` — reproduced from this archive before publishing [`docs/provenance/REPRO_VERIFICATION.json`].

## Attestations and signature

- SBOM + SLSA provenance attached to the image: attached: an SPDX SBOM and SLSA v1 provenance [`docs/provenance/SCOUT_VERDICT.json`]
- cosign signature by the ReadyStack release key: verified before publishing. Check it: `cosign verify --key https://readystack.dev/keys/cosign.pub readystack/drupal:11.4.13-CE-ubuntu24.04-r2`

## Pinned inputs, and why

- 17 pinned inputs, each with where it came from, why this one, how it was checked and when it was decided: `docs/PINS.md` [`docs/provenance/PINS.json`] (upstream source 2, base and build images 1, image digests 2, language runtimes and toolchains 1, dependency versions readystack sets 4, pins in the kit's dockerfiles 3, readystack's build engine 2, dependencies upstream chose 2).

## Build trail

- How this release passed through the ReadyStack harness, record by record (every chain, drive, stage, review round, defect and check, each naming the record it is copied from): `ReadyStack-drupal-11.4.13-CE-ubuntu24.04-r2.trail.json`, published beside this archive and signed with the release key (`ReadyStack-drupal-11.4.13-CE-ubuntu24.04-r2.trail.json.sigstore`), and readable at https://readystack.dev/products/drupal/trail/11.4.13-CE-ubuntu24.04-r2.

