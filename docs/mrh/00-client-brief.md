# Client brief — Mister Hypnosis (misterhypnosis.com) design refresh

## Project

Polish the existing Mister Hypnosis site to modern standards while keeping the
design recognisably the same. This is a refresh, not a repositioning: same
one-page structure, same content, same entertainer brand — tightened typography,
spacing, mobile behavior, accessibility, and performance.

Client-facing site: <https://misterhypnosis.com> (currently a WordPress.com
one-pager). Target theme already exists in this repo at
`themes/misterhypnosis/` and was built as the redesign track.

## Audience

- Schools booking Grad Nights / proms (clean-comedy requirement is a selling point)
- Corporate event planners (100+ companies claimed on the live site)
- College event bookers
- Private parties / theaters / fairs

## Current live site (observed)

Single scrolling page: full-bleed red photo cover hero ("MISTER HYPNOSIS /
RICHARD RUMBLE / COMEDY HYPNOTIST" in condensed white caps, "Book Mister
Hypnosis" pill button) → About → Services (Corporate Events, College Events,
Magic) → Clients logo grid → Gallery → Contact form → red footer band.

Palette on live site: saturated red + black, white condensed type, gray-blue
form inputs, red footer band.

## Repo theme (existing redesign track)

`themes/misterhypnosis/` already implements a one-page build: sticky glass
header with lockup + nav + phone + CTA, hero (portrait or Vimeo reel), client
logo marquee, one section per `mrh_audience` post, About with credentials chip
list, testimonials, gallery, booking form (honeypot + nonce + Enquiry CPT),
footer with contact info and sister-site links. Palette is deep aubergine +
gold on near-black; Playfair Display + Inter.

## Scope of this refresh

- Keep the established structure and ACF-editable content model.
- Polish visuals to current standards: type scale, spacing rhythm, motion,
  focus states, card treatments, image handling.
- Add the phone number (714) 322-0207 (placement TBD — see questions).
- Stay inside the playbook: HTML/CSS artifacts first, one approval gate before
  the build pass, everything client-editable stays an ACF field.

## Open questions for Fredie

1. **Palette direction** — "keep the design relatively the same": same as
   WHICH design? (a) the live site's red-on-black look, or (b) the repo
   theme's aubergine/gold theatre look? Recommendation below.
2. **Phone number** — does (714) 322-0207 replace (949) 496-6244 everywhere,
   or appear alongside it (e.g. "call or text")?
3. **Assets** — portraits/logo PNGs for hero + marquee still outstanding per
   `docs/open-questions.md`. Proceed with the existing placeholder states, or
   are the real files coming?
4. **Destination** — this refresh lands in the repo theme first; deployment to
   misterhypnosis.com (WordPress.com → needs a host that runs custom themes,
   or WordPress.com Business) stays a separate open item from
   `docs/open-questions.md` §5. Confirm that's still the plan.
