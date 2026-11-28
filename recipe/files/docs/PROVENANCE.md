# Provenance — Drupal (`11.4.14-CE-ubuntu24.04-r1`)

Every item below is copied from a record in this archive; the record is named in brackets.

## Source

- Upstream repository: https://github.com/drupal/recommended-project
- Revision built: `11.4.14` (commit `8e3faf842ef787b28a44a4d911c7a493a69ad515`)
- Source tree: `e44288fed4cc8f7380266fa9f98c765a4dba7a944569bb7116f16c55cafb83bb` over 3 files [`docs/provenance/SOURCE_TREE_HASH.json`]
- Community Edition only: enterprise code is removed or refused before the build (CE audit at acquire).

## Build

- Method: `source-rebuild-php`; base image `ubuntu:24.04`
- Built with `--network=none` from vendored source, dependencies and base images; BuildKit pinned to `moby/buildkit:v0.31.2` (shipped in `toolchain/`).
- SOURCE_DATE_EPOCH: `1795849550` [`SOURCE_DATE_EPOCH.txt`]
- Frozen inputs: [`docs/provenance/FREEZE_MANIFEST.json`], build recipe: [`docs/provenance/BUILD_RECIPE.json`].

## Output

- Published image: `readystack/drupal:11.4.14-CE-ubuntu24.04-r1` — index digest `sha256:f460965a10e8597a1480736e59fa659181c9978bf4210d88428226b86925b248` [`docs/provenance/LOCKED_DIGEST.txt`]
- linux/amd64 image digest `sha256:b0922a4ab3f956ff1d4952a7397e4499c33dff70e15021122af866d7dbfa61a5` — reproduced from this archive before publishing [`docs/provenance/REPRO_VERIFICATION.json`].

## Attestations and signature

- SBOM + SLSA provenance attached to the image: attached: an SPDX SBOM and SLSA v1 provenance [`docs/provenance/SCOUT_VERDICT.json`]
- cosign signature by the ReadyStack release key: verified before publishing. Check it: `cosign verify --key https://readystack.dev/keys/cosign.pub readystack/drupal:11.4.14-CE-ubuntu24.04-r1`

## Pinned inputs, and why

- 18 pinned inputs, each with where it came from, why this one, how it was checked and when it was decided: `docs/PINS.md` [`docs/provenance/PINS.json`] (upstream source 2, base and build images 1, image digests 2, language runtimes and toolchains 1, dependency versions readystack sets 5, pins in the kit's dockerfiles 3, readystack's build engine 2, dependencies upstream chose 2).

## Build trail

- How this release passed through the ReadyStack harness, record by record (every chain, drive, stage, review round, defect and check, each naming the record it is copied from): `ReadyStack-drupal-11.4.14-CE-ubuntu24.04-r1.trail.json`, published beside this archive and signed with the release key (`ReadyStack-drupal-11.4.14-CE-ubuntu24.04-r1.trail.json.sigstore`), and readable at https://readystack.dev/products/drupal/trail/11.4.14-CE-ubuntu24.04-r1.

