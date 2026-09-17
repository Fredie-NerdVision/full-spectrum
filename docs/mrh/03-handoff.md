# Mister Hypnosis — Site Handoff

**Live:** https://misterhypnosis.com (WordPress.com, Atomic on Premium plan)
**Theme:** `misterhypnosis` (built by NerdVision) — ACF-driven single-page theme, no page builders.
**Deployed:** 2026-09-17

## How content is organised

The homepage is a single page ("Home") rendered by the theme's `front-page.php`.
Text and images come from two places:

| What | Where to edit it |
|---|---|
| Hero kicker/heading/intro, hero photo, hero video | **Home** page → ACF panel "Home page content" |
| About heading/body/photo, credentials list | Same Home page ACF panel |
| Section headings + booking text, footer phone/email/address/socials | Same Home page ACF panel |
| Audience sections (kickers, taglines, bullet lists, CTAs) | **Audiences** menu → each post; featured image = the section photo |
| Client logos in the marquee | **Client Logos** menu → featured image = the logo |
| Quotes | **Testimonials** menu; set "Audience" field to pin a quote inside an audience section |
| Gallery grid | **Gallery** menu → featured image + caption |

## Notes for ongoing work

- Phone number is (714) 322-0207 — editable in one place: Home page → `footer_phone`; header/booking/footer read from it with hardcoded defaults in `header.php`, `footer.php`, `template-parts/booking.php`.
- Videos are optional: setting `hero_video` or an audience `audience_video` (Vimeo ID) swaps the photo for an embed.
- The booking form is theme-native (`template-parts/booking.php`) with a honeypot; submissions email `contact_recipients` (currently hypno2u@hotmail.com, hypno2u@icloud.com, richard@misterhypnosis.com).
- SSH/WP-CLI are unavailable on the Premium plan (Business/Commerce only). Bulk content changes can be seeded via XML-RPC + REST with an application password (see `tools/seed-mrh-content.php` for the canonical content set) or via a WXR import in Tools → Import.
- Plugin set is minimal: ACF 6.x, Jetpack, Akismet, Page Optimize, Gutenberg.

## Design reference

See `docs/mrh/02-design-direction.md` and `design/mrh/` (style tile, prototype, assets).
