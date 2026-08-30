# Design notes

## Full Spectrum Educational Services (full-spectrum.org)

- **"Making Education a Spectacle" is gone.** The hero now leads with the audience
  and the outcome rather than a pun, and the header lockup enlarges
  *Educational* so the site reads as the schools/libraries arm of the brand.
- **Deep sub-pages collapse into one scrolling page.** The old Home → Space
  Exploration → Science tree buried the catalog. The front page now runs
  hero → quick nav → one section per service group → credentials → booking, and
  the quick-nav buttons are anchor links generated from the `Service Groups`
  taxonomy:
  1. Assembly Programs (STEM, character building, magic, reading)
  2. Science Nights & Workshops
  3. School Carnivals & Festivals
  4. School Dances & Proms
  5. Grad Nights
- **Every program is a post, not hard-coded markup.** 14+ catalog entries are
  seeded by `tools/seed-fse-programs.php`, each with tagline, audience, duration,
  highlights and price fields, plus a `single-fse_program.php` detail page for
  search traffic and printable one-sheets.
- **"Photo coming soon" is a first-class state.** Toggling
  *Awaiting photography* renders a branded placeholder card instead of a broken
  or borrowed clip-art image, so new shows can go live before the photo shoot.
  The placeholder picks up the service group's icon and a pastel tint that cycles
  per card, so a 12-card grid of pending photos still looks intentional.
- **Art direction is aimed at K-6 (client direction).** The audience is mostly
  young elementary students, so the theme runs bright sky-blue → teal gradients,
  confetti dots and a scalloped section edge, sticker-style cards with 3px navy
  outlines and offset colour shadows, crayon underlines under section headings,
  and headline copy about bubbles/lightning/magic instead of institutional
  language. Text stays navy on light backgrounds for contrast.
- **Header menu labels are editable per service group.** Full names such as
  *School Carnivals & Festivals* overflow a one-line menu, so each group has an
  optional shorter *Menu label* field (`group_nav_label`) used in the header only.
- **Booking form accessibility.** Real `<label>` elements, hint text wired with
  `aria-describedby`, a non-required *Date of Event* field, 2px high-contrast
  input borders (the old hairline inputs were invisible on school monitors and
  projectors), and visible focus outlines. `Reply-To` is the submitter.
- Palette moves off the WordPress.com purple/blue blocks to bright blue, teal,
  amber, tangerine and coral, with navy reserved for text and outlines.

## Mister Hypnosis (misterhypnosis.com)

- **Credentials up front.** Magic Castle, National Guild of Hypnotists, ABH,
  Society of Applied Hypnosis and IBM render as a chip list in the About section
  and are editable as one textarea.
- **The signature looks drive the art direction.** Hero portrait slot is sized
  for the purple jacket shot; the About portrait slot is sized for the red suit /
  pocket watch artwork. Palette is deep aubergine with gold, so both shots sit on
  a background made for them.
- **Audience-specific sections replace one long undifferentiated page.** Grad
  Nights & proms, corporate functions and college events are each an `Audience`
  post with its own kicker, bullet points, testimonial(s) and video — rendered
  both as a home-page section and as a standalone URL.
- **Legacy AudioAcrobat embeds are gone.** `mrh_vimeo_embed()` takes a bare Vimeo
  ID and outputs a responsive, lazy-loaded, DNT-enabled iframe. Seeded IDs:
  954992581 (high-school testimonial), 955007390 (performance reel), 879489607
  (stage illusion).
- **Client logos scroll.** The static logo cluster becomes a CSS marquee that
  pauses on hover/focus and is disabled under `prefers-reduced-motion`; the
  duplicated track is `aria-hidden` so screen readers hear each client once.
- **Booking form** posts to the three intended recipients
  (`hypno2u@hotmail.com`, `hypno2u@icloud.com`, `richard@misterhypnosis.com`,
  editable in ACF), stores an `Enquiry` post, and includes an event-type select
  plus an optional event date.

## Shared

- No page builder. Elementor would need a WordPress.com Business upgrade on both
  sites and adds a licence and an upgrade path the client would have to maintain;
  ACF fields give the same editing safety with no layout to break.
- Mobile-first: single-column below 900px, hamburger nav, 44px+ tap targets,
  `prefers-reduced-motion` respected.
- Honeypot + nonce on both forms; no third-party form plugin needed.
