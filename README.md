# NerdVision — Full Spectrum Web Properties

Custom WordPress themes for the Full Spectrum Entertainment & Educational Services
family of sites. Every piece of client-facing copy, imagery, pricing and video is
an ACF field, so Sandee and Richard can edit content without touching layout.

| Theme | Site | Text domain |
| --- | --- | --- |
| `themes/fse-educational` | www.full-spectrum.org — school & library assemblies | `fse` |
| `themes/misterhypnosis` | www.misterhypnosis.com — stage hypnosis & magic | `mrh` |

`www.fullspectrument.com` (currently Wix) and `dreamshapers.org` (HostGator) are
not in this repo yet — see `docs/open-questions.md`.

## Requirements

- WordPress 6.4+
- PHP 8.0+
- Advanced Custom Fields (free edition is sufficient — no Pro-only field types are used)

## Install

1. Copy the theme folder into `wp-content/themes/`.
2. Activate the theme and activate ACF.
3. Create a page (e.g. "Home") and set it as the static front page under
   **Settings → Reading**. The single-page layout renders from `front-page.php`,
   and all global fields are attached to that page.
4. Seed the catalog content with WP-CLI:

   ```bash
   wp eval-file tools/seed-fse-programs.php   # 14+ assembly / science / carnival programs
   wp eval-file tools/seed-mrh-content.php    # audience sections, testimonials, home copy
   ```

5. Upload the logo (**Appearance → Customize → Site Identity**) and the header
   banner / portraits into the matching ACF image fields.

## What the client edits

- **Full Spectrum**: Home page fields (hero banner, headings, contact recipients,
  footer details), `Programs` posts (one card per offering, with a
  "photo coming soon" toggle that renders a branded placeholder), and
  `Service Groups` terms (icon, blurb, image) which drive both the quick-nav
  buttons and the on-page section order.
- **Mister Hypnosis**: Home page fields (hero, about, credentials, booking
  recipients, footer), `Audiences` posts (Grad Nights, corporate, college — each
  with bullet points and a Vimeo ID), `Testimonials`, `Clients` (logo marquee) and
  `Gallery`.

Field groups are registered in PHP (`inc/acf-fields.php`) so they ship with the
theme, and ACF JSON save/load is pointed at `acf-json/` so any admin-side edits
land in version control.

## Booking forms

Both themes store every submission as a private `Enquiry` post **before** mailing
the notification, so a mail-routing problem cannot lose a lead. Notifications
are sent to the comma-separated recipients in the home-page ACF field, with
`Reply-To` set to the submitter and `From` set to `website@<site-domain>` for SPF
alignment.

## Local development

```bash
find themes tools -name '*.php' -print0 | xargs -0 -n1 php -l   # syntax lint
```
