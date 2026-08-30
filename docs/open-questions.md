# Open questions for client sign-off

## Assets

1. The horizontal header banner and the purple-jacket / red-suit portraits from
   the spec's asset registry have not been supplied. The themes have ACF image
   fields ready; until files land, the hero falls back to type-only and program
   cards render the "photo coming soon" placeholder.
2. Client logos for the Mister Hypnosis marquee — need transparent PNG or SVG
   files. The marquee section hides itself entirely until at least one exists.

## Content

3. Pricing: program posts have a price field but no numbers were supplied. Leave
   blank ("Call for pricing") or publish rates?
4. Grad Night and carnival descriptions were reconstructed from the catalog in the
   spec — Sandee should review wording before launch.

## Infrastructure — spec vs. observed reality

5. **full-spectrum.org nameservers are WordPress.com, not GoDaddy** (spec §6B
   assumes GoDaddy). Moving to a host that can run these themes means a DNS
   change; who holds the WordPress.com account?
6. **misterhypnosis.com MX records are not missing.** GoDaddy DNS points at
   Proofpoint/Microsoft 365 with valid SPF, so the lost-lead problem is mailbox
   forwarding or the old form plugin, not absent MX. The new form storing every
   enquiry as a post removes the data-loss risk regardless; we still need mailbox
   access to fix delivery.
7. **fullspectrument.com is a Wix site** ("SpectrumHub"), so the Elementor
   training and marquee items in the spec do not apply as written. Rebuild it as a
   third WordPress theme in this repo, or leave on Wix for now?
8. **dreamshapers.org P2 items already pass**: SSL is valid through Feb 2027 and
   `/Chazz/` already 301s to `/drum-circles-101/`. The spec asked for
   `/DrumCircles101/`, which 404s. Confirm the lowercase target is acceptable.

## Access still needed

9. WordPress admin for both sites, GoDaddy + WordPress.com DNS, and the
   Microsoft 365 / GoDaddy mail console — nothing in this repo can be deployed or
   mail-tested without them.
