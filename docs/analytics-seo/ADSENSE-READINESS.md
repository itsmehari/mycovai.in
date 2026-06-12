# AdSense readiness (mycovai.in)

Checklist and runbook for Google AdSense application and post-approval setup.

**Deferred (manual):** root `ads.txt` at `https://mycovai.in/ads.txt` — deploy separately when ready.

---

## Pre-application checklist

- [ ] Privacy policy includes advertising / AdSense section (`privacy-policy.php`, effective 29-05-2026)
- [ ] Cookie notice visible on main templates (`components/cookie-notice.php`)
- [ ] About, Contact, Terms, Privacy linked from footer
- [ ] Job landings use Coimbatore URLs (`jobs-in-coimbatore.php`, locality pages)
- [ ] Old OMR job URLs 301 redirect (`.htaccess`)
- [ ] `jobs/sitemap.xml` and root `sitemap.xml` list Covai job pages only
- [ ] No stray `adsbygoogle` outside `components/adsense.php`
- [ ] `ADSENSE_ENABLED` is `false` during review (no empty ad boxes)
- [ ] Root `ads.txt` returns 200 (you handle this step)

---

## AdSense configuration

Edit `core/mycovai-config.php`:

| Constant | Purpose |
|----------|---------|
| `ADSENSE_ENABLED` | `false` until approved; then `true` |
| `ADSENSE_CLIENT_ID` | Publisher ID (`ca-pub-…`) |
| `ADSENSE_SLOT_UNITS` | Map site slot ID → AdSense ad unit ID |
| `ADSENSE_MAX_UNITS_PER_PAGE` | Default `3` |

Example after approval:

```php
define('ADSENSE_ENABLED', true);
define('ADSENSE_SLOT_UNITS', [
    'homepage-mid'   => '1234567890',
    'article-mid'    => '2345678901',
    'article-bottom' => '3456789012',
    'listing-mid'    => '4567890123',
    'detail-mid'     => '5678901234',
]);
```

---

## Slot mapping (tier 1)

Use `covai_monetized_slot()` in templates — AdSense when enabled, else registry banners.

| Site slot | Surfaces |
|-----------|----------|
| `homepage-mid` | `index.php` |
| `article-mid`, `article-bottom` | `local-news/article.php` via `components/article-ad-banner.php` |
| `listing-mid` | `directory/directory-template.php`, `directory/schools.php`, `directory/restaurants.php` |
| `detail-mid` | `directory/school.php`, `directory/restaurant.php` |

`homepage-top` card row stays registry-only (`covai_ad_banner_row`).

---

## Pages that must NOT show AdSense

Enforced in `core/adsense-placement.php`:

- Employer login/register/dashboard
- Job post / apply / process / success pages
- Admin (`/admin/`, `/jobs/admin/`, `/local-events/admin/`)

---

## Post-approval steps

1. Add `mycovai.in` as a site in AdSense (if not already).
2. Create ad units; paste IDs into `ADSENSE_SLOT_UNITS`.
3. Set `ADSENSE_ENABLED` to `true` and deploy.
4. Verify units on homepage, one article, one directory page.
5. Confirm `ads.txt` at domain root (separate task).
6. Resubmit sitemap in Search Console if URLs changed.

---

## Related files

- `components/adsense.php` — script loader and unit renderer
- `components/ad-banner-slot.php` — `covai_monetized_slot()`
- `core/adsense-placement.php` — denylist
- `docs/ads.md` — registry banners + AdSense overview
- `affiliate-disclosure.php` — affiliate + display advertising disclosure
