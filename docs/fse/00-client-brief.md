# Client brief — Full Spectrum Educational Services (full-spectrum.org) redesign

## Project

Redesign full-spectrum.org to modern standards. Unlike the Mister Hypnosis
refresh (which kept the live look), this one is a proper redesign: the site
must read as **fun for kids' school activities while looking credible and
consistent to the administrators who book them**. Phone number is
(949) 496-6244 everywhere — the live site currently shows none.

Client-facing site: <https://full-spectrum.org> (WordPress.com, block theme).
Target theme exists in this repo at `themes/fse-educational/` and was built as
the redesign track.

## Audience

- School administrators, principals, activities directors, PTA/PTO boards
- Public library programming coordinators
- Decision-makers who need safety, standards-alignment and reliability proof

## Current live site (observed)

Block theme: flat purple hero ("MAKING EDUCATION A SPECTACLE"), red text nav
(only 3 items: Home, Space Exploration, Science — the other six categories are
homepage-only), eight flat category blocks (Space Exploration, Science,
Character Development, Nature & Conservation, Reading & Literature, Music and
Storytelling, Magical Assemblies, Parties and Celebrations), Jetpack contact
form, minimal footer. No phone number anywhere.

Palette: saturated purple + white condensed caps + red accents + blue button.

## Repo theme (existing redesign track)

`themes/fse-educational/` implements a one-page build: sticky header (text
lockup + nav + phone + CTA) → hero (banner image + trust list) → quick-nav →
one card-grid section per service-group term → credentials → contact form
(honeypot + nonce). Content model: `fse_program` CPT + `fse_service_group`
taxonomy (5 groups), ACF home fields + term meta (icon/nav label/blurb),
`tools/seed-fse-programs.php` seeds 19 real programs.

Palette: deep navy ink + bright sticker accents (Fraunces + Inter).

## Scope of this redesign

- Keep the established structure and ACF-editable content model; 5 service
  groups with the 19 seeded programs (richer than the live 8 flat categories —
  covers the same catalogue).
- New visual direction: playful enough to signal "kids will love this",
  disciplined enough to signal "administrators can trust us".
- Phone (949) 496-6244 in header (clickable pill), contact section, footer.
- Stay inside the playbook: HTML/CSS artifacts first, one approval gate before
  the build pass, everything client-editable stays an ACF field.

## Decisions

- Structure: theme's 5 service groups (user skipped — went with richer model).
- Phone: (949) 496-6244, per Sandee Gee's consolidated spec (client decision).
- Look: full redesign (user direction — not the live purple wall, not the
  repo's first-draft navy stickers; a new "playground energy, district-office
  polish" system).
