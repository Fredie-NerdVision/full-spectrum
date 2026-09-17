# Design direction — Mister Hypnosis refresh

Approved direction: keep the **live site's look** — red-on-black, condensed
caps — and port the repo theme toward it. Refresh polish, not a new brand.

## Palette

| Token | Value | Use |
|---|---|---|
| `--ink` | `#0b0a0e` | Page background |
| `--ink-soft` | `#141218` | Alternate sections, cards |
| `--red` | `#e01f26` | Primary accent, CTAs, kickers, footer band |
| `--red-deep` | `#8f1017` | Hover states, gradient depth |
| `--cream` | `#faf7f2` | Body text on dark |
| `--muted` | `#b3abb4` | Secondary text |
| `--line` | `rgba(255,255,255,.14)` | Hairlines |

(No gold — the live site is strictly red/white/black; the aubergine/gold
tokens in the repo theme get retired in favor of this ramp.)

## Typography

- **Display:** Fjalla One (Google Fonts) — the same condensed face the live
  site uses for "RICHARD RUMBLE / COMEDY HYPNOTIST". All headings + lockup +
  kickers render in it, uppercase, tight letterspacing.
- **Body:** Inter — same as the live site's body copy.
- Scale: hero `clamp(2.8rem, 8vw, 5.5rem)`, section headings
  `clamp(2rem, 4.5vw, 3rem)`, body 1.0625rem/1.65.

## Structure (unchanged from repo theme)

One page: sticky header (lockup + nav + phone + "Check Your Date" CTA) →
red-cover hero → client logo marquee → audience sections (alternating media) →
About + credentials chips → testimonials → gallery → booking → red-band footer.
Every editable string stays an ACF field; audiences stay a CPT.

## Polish items ("new standards")

- Full-bleed hero: client's House of Blues stage photo under a light red
  gradient overlay + bottom fade, left-aligned condensed headline stack kept
  below the performer's face line; CTA pair (Book / See the shows).
- "Trusted by" marquee: client logos in **colour on white cards** (not
  monochrome), tight strip — no large empty band.
- Sticky header gains a red bottom edge on scroll; nav phone becomes
  (714) 322-0207.
- Marquee pauses on hover and is reduced-motion safe (already in repo theme —
  kept).
- Cards: testimonials/gallery get a 1px `--line` border + deep-red top accent,
  subtle lift on hover.
- Booking form: dark card, light inputs with 2px borders and red focus ring —
  same a11y rules as the FSE theme (labels, `aria-describedby` hints, honeypot,
  nonce, `Reply-To`).
- Footer keeps the signature **red band** from the live site, now a 3-column
  contact/menu/legal layout instead of a single centered line.
- Focus-visible rings in red on cream, 44px+ tap targets, single column
  ≤900px, `prefers-reduced-motion` respected.

## Content/contact changes

- Phone **(714) 322-0207** replaces (949) 496-6244 in header, booking section,
  footer, ACF defaults, and `tools/seed-mrh-content.php`. The same number in
  the `fse-educational` theme is untouched — flagged as a separate decision.
- Copy carries over from ACF defaults/seed (already written); any gaps marked
  `[DRAFT COPY]`.

## Imagery (approved set from the client's media library)

| Slot | Photo | Notes |
|---|---|---|
| Hero backdrop | `house-of-blues-1.jpg` | Hi-res stage shot, red jacket/hat, House of Blues marquee |
| Grad Nights & Proms | `purple-jacket-crop.jpg` | Signature purple jacket, volunteers on stage |
| Corporate Functions | `prom-viewing-2021.jpeg` | Packed ballroom crowd |
| College Events | `usc-1.jpg` | USC campus event |
| About portrait | `silver-coat.jpg` | Clean studio portrait |
| Gallery (5) | `img_1681`, `wedding-magic-show`, `prom-2021`, `close-up-red-coat`, `stage-setup` | No photo repeats across the page |
| Logo cards (11) | disney, dave-busters, pfizer, ford, club-med, UCI, hornblower, kaiser, el-torito, cada, mammoth-lakes | Colour, white card backing |

The low-res `hypno-background.jpeg` composite (spiral + pasted face) is
retired — it caused the "pixelated, pasted-on" hero feedback.

## Artifacts

- `design/mrh/style-tile.html` — palette, type scale, buttons, hero sample.
- `design/mrh/prototype/home.html` — full-page high-fidelity mockup using the
  client's real photos/logos; markup doubles as the build base.
