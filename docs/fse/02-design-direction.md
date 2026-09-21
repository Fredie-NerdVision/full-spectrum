# Design direction — Full Spectrum Educational redesign

Approved premise: **"playground energy, district-office polish."** The site
sells to administrators, so the frame is serious (consistent grid, real photos,
credential proof, plain-language meta) while the surfaces stay fun (color,
sticker cards, playful display type).

## Palette

| Token | Value | Use |
|---|---|---|
| `--ink` | `#17235c` | Body text, sticker borders, footer |
| `--violet` | `#7a2ee0` | Brand primary — keeps the live site's purple identity |
| `--violet-deep` | `#4f169e` | Hero gradient depth, hover |
| `--indigo` | `#1b2a6b` | Hero gradient base |
| `--paper` | `#fffdf7` | Page background (warm white) |
| `--blue` `#2f6dff` / `--violet` / `--coral` `#ff5d73` / `--sky` `#59c2ff` / `--amber` `#ffc528` | Group accents | One per service group — playful *and* systematic |

## Typography

- **Display:** Fraunces (already the theme's display face — warm, credible,
  slightly quirky serif. Uppercase for hero + section headings.)
- **Body:** Inter.
- Hero `clamp(2.6rem, 7vw, 4.6rem)`, section headings `clamp(1.9rem, 4vw, 2.8rem)`.

## Structure (unchanged from repo theme)

Sticky header (lockup + nav + **(949) 496-6244 pill** + Check Your Date CTA) →
gradient hero (real crowd photo in a sticker frame + trust list) → quick-nav →
5 service-group card grids → credentials band → contact form → navy footer.
Every editable string stays an ACF field; programs stay the CPT.

## Polish items ("new standards")

- Hero: indigo→violet gradient (brand purple kept, but dimensional not flat),
  confetti-dot texture, headline + sub aimed at administrators, **real gym
  crowd photo** in a tilted sticker frame — instant social proof.
- Sticker cards: 2.5px ink border + hard offset shadow + group-colored top
  bar — fun surface, consistent system. Hover lifts.
- Per-group identity: each service group gets an accent color + icon chip,
  used in its heading underline, quick-nav tile, and card top-bars.
- Program cards: art (real photo or branded placeholder glyph) + discipline
  eyebrow + title + tagline + excerpt + Ages/Format/From meta rows — the
  details an administrator compares.
- Credentials band: violet-tinted, professor photo + NASA/Fire Marshal copy.
- Contact: card form with labeled inputs, focus rings, phone pill beside it.
- Footer: navy band, 3-column (brand/contact/sister sites), linked NerdVision
  credit with the same gradient flair as the MRH footer.
- Focus-visible rings, 44px tap targets, single column ≤900px,
  `prefers-reduced-motion` respected.

## Content changes

- Phone **(949) 496-6244** stays as the single number in header, contact,
  footer, ACF defaults, and `tools/seed-fse-programs.php` if present.
- Footer gains a linked "Designed by NerdVision".

## Imagery

Client feedback (Sept 2026): drop the AI illustrations — too busy and
inconsistent. Program cards therefore use a uniform branded tile (group
accent color + ★ mark + "Full Spectrum Program") for ALL programs — simple,
consistent, zero missing-photo problem. Photos can drop in later per card.

| Slot | Image | Notes |
|---|---|---|
| Hero photo | `gym-1.jpeg` | Real assembly crowd + Richard — stand-in until the Aug-20 horizontal banner is supplied |
| Credentials | `zany-professor.png` | Character shot |
| Program art | Uniform branded tiles per group accent | Photography drops in card-by-card later |

## Sandee spec alignment (Consolidated Requests doc, via Drive)

- No "spectacle" tagline anywhere — headline is
  "Assemblies Your Students Love. Paperwork You Can Trust."
- "EDUCATIONAL" is the enlarged emphasis line in the header/footer lockup.
- 5 quick-nav buttons match Sandee's list verbatim (Assembly Programs,
  Science Nights & Workshops, School Carnivals & Festivals,
  School Dances & Proms, Grad Nights).
- Placeholder cards for shows without photos — explicitly requested.
- All 19 seeded programs map to the verified catalog incl. Rumbledoor
  (Earth Day) and Drumming to the Beat (DreamShapers).
- Form: "Date of Event" non-required field, high-contrast input borders,
  Reply-To = submitter email (implementation note for handoff).
- Audience reality in copy: preschools + libraries named in hero intro
  (they're ~60–70% of booking volume per the spec).
- Open item: the new horizontal header banner (Sandee email Aug 20, 2026)
  is an email attachment we don't have yet — `gym-1.jpeg` stands in until
  it's supplied.

## Artifacts

- `design/fse/style-tile.html` — palette, type scale, buttons, card samples.
- `design/fse/prototype/home.html` — full-page high-fidelity mockup;
  markup doubles as the build base.
