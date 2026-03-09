# MyCovai: Table-by-Table Suitability for Covai (Coimbatore)

**Purpose:** For each table in `metap8ok_myomr`, assess whether it is **suitable for Covai** (Coimbatore): schema, data, and naming.

**Verdicts:**
- **Yes** – Schema and purpose fit Covai; use as-is (same table name) with Coimbatore data or empty.
- **Yes, data replace** – Schema fits; keep table name; replace Chennai data with Coimbatore seed or leave empty.
- **Yes, optional rename** – Suitable; optionally rename `omr_*` → `covai_*` (requires PHP updates).
- **No** – Not suitable for Covai; drop or replace with a Covai-specific alternative.

---

## 1. admin_audit_log
| Aspect | Assessment |
|--------|------------|
| **Schema** | Generic: admin user, action, timestamp, details. No region. |
| **Data** | Chennai admin actions; not useful to migrate. |
| **Suitable for Covai?** | **Yes** |
| **Action** | Keep table; copy schema; start with empty. Same name. |

---

## 2. admin_users
| Aspect | Assessment |
|--------|------------|
| **Schema** | Generic: username, password, role. No region. |
| **Data** | Same admin can manage MyCovai or create new Covai admin. |
| **Suitable for Covai?** | **Yes** |
| **Action** | Keep table; copy schema; migrate one admin or create new. Same name. |

---

## 3. articles
| Aspect | Assessment |
|--------|------------|
| **Schema** | Generic: title, slug, content, date, section. No region in structure. |
| **Data** | OMR/Chennai articles; content is region-specific. |
| **Suitable for Covai?** | **Yes, data replace** |
| **Action** | Keep table; copy schema; leave empty or add Coimbatore articles. Same name. |

---

## 4. businesses
| Aspect | Assessment |
|--------|------------|
| **Schema** | Generic business directory fields. No OMR in structure. |
| **Data** | Likely OMR businesses; not for Covai. |
| **Suitable for Covai?** | **Yes** |
| **Action** | Keep table; copy schema; empty or seed Coimbatore businesses. Same name. |

---

## 5. coworking_spaces
| Aspect | Assessment |
|--------|------------|
| **Schema** | Generic: name, address, locality, owner, amenities. Works for any city. |
| **Data** | OMR/Chennai addresses. |
| **Suitable for Covai?** | **Yes, data replace** |
| **Action** | Keep table; copy schema; empty or seed Coimbatore coworking spaces. Same name. |

---

## 6. employers
| Aspect | Assessment |
|--------|------------|
| **Schema** | Generic: company, contact, login. No region. |
| **Data** | OMR employers; Covai will have new signups. |
| **Suitable for Covai?** | **Yes** |
| **Action** | Keep table; copy schema; empty. Same name. |

---

## 7. events
| Aspect | Assessment |
|--------|------------|
| **Schema** | Simple event fields; may overlap with `event_listings`. |
| **Data** | OMR events. |
| **Suitable for Covai?** | **Yes, data replace** |
| **Action** | Keep table if code uses it; else consolidate with `event_listings`. Same name. |

---

## 8. event_attendees
| Aspect | Assessment |
|--------|------------|
| **Schema** | Generic: event_id, name, email. No region. |
| **Data** | Tied to events; start empty. |
| **Suitable for Covai?** | **Yes** |
| **Action** | Keep table; copy schema; empty. Same name. |

---

## 9. event_categories
| Aspect | Assessment |
|--------|------------|
| **Schema** | Generic: name, slug, display_order. Region-agnostic. |
| **Data** | Community, Education, Sports, etc.—reusable everywhere. |
| **Suitable for Covai?** | **Yes** |
| **Action** | Keep table; copy schema + data (categories). Same name. |

---

## 10. event_listings
| Aspect | Assessment |
|--------|------------|
| **Schema** | Generic: title, location, locality, dates, category. Works for Covai. |
| **Data** | OMR events. |
| **Suitable for Covai?** | **Yes, data replace** |
| **Action** | Keep table; copy schema; empty or seed Coimbatore events. Same name. |

---

## 11. event_submissions
| Aspect | Assessment |
|--------|------------|
| **Schema** | Generic pending submissions. No region. |
| **Data** | Start empty. |
| **Suitable for Covai?** | **Yes** |
| **Action** | Keep table; copy schema; empty. Same name. |

---

## 12. gallery
| Aspect | Assessment |
|--------|------------|
| **Schema** | Generic: image, caption, etc. No region. |
| **Data** | OMR images; optional to migrate. |
| **Suitable for Covai?** | **Yes** |
| **Action** | Keep table; copy schema; empty or Covai images. Same name. |

---

## 13. hostels_pgs
| Aspect | Assessment |
|--------|------------|
| **Schema** | Generic: owner_id, locality, address, rent, type. Works for any city. |
| **Data** | OMR localities and addresses. |
| **Suitable for Covai?** | **Yes, data replace** |
| **Action** | Keep table; copy schema; empty or seed Coimbatore hostels/PGs. Same name. |

---

## 14. job_applications
| Aspect | Assessment |
|--------|------------|
| **Schema** | Generic: job_id, applicant info. No region. |
| **Data** | Start empty. |
| **Suitable for Covai?** | **Yes** |
| **Action** | Keep table; copy schema; empty. Same name. |

---

## 15. job_categories
| Aspect | Assessment |
|--------|------------|
| **Schema** | Generic: name, slug. Region-agnostic. |
| **Data** | IT, Healthcare, etc.—reusable. |
| **Suitable for Covai?** | **Yes** |
| **Action** | Keep table; copy schema + data. Same name. |

---

## 16. job_postings
| Aspect | Assessment |
|--------|------------|
| **Schema** | Generic: employer_id, category, location, title. Location = text/area. |
| **Data** | OMR locations; Covai will use Coimbatore areas. |
| **Suitable for Covai?** | **Yes, data replace** |
| **Action** | Keep table; copy schema; empty. Use "List of Areas" for location dropdown. Same name. |

---

## 17. List of Areas
| Aspect | Assessment |
|--------|------------|
| **Schema** | Sl No, Areas (varchar). Generic. |
| **Data** | Currently OMR areas (Tidel Park, Thiruvanmiyur, etc.). |
| **Suitable for Covai?** | **Yes, data replace** |
| **Action** | Keep table; replace data with Coimbatore localities (RS Puram, Gandhipuram, Peelamedu, etc.). **Critical for Phase 5.1.** Same name. Seed: `database/seed-covai-list-of-areas.sql`. **PHP uses:** `index.php`, `news-highlights-from-omr-road.php`, `omr-news-list-of-areas-covered.php`. |

---

## 18. omrbankslist
| Aspect | Assessment |
|--------|------------|
| **Schema** | bankname, address, locality, contact, landmark. Works for any city. |
| **Data** | OMR/Chennai bank branches. |
| **Suitable for Covai?** | **Yes, data replace** |
| **Action** | Keep table name (so PHP keeps working); copy schema; seed Coimbatore bank branches. **PHP uses:** `omr-listings/banks.php`, `bank.php`, `generate-listings-sitemap.php`. Optional rename to `covai_banks` later + update PHP. |

---

## 19. omrelections_civic_issues
| Aspect | Assessment |
|--------|------------|
| **Schema** | constituency_id, locality_id, issue, status. Generic elections. |
| **Data** | Chennai constituencies/localities. |
| **Suitable for Covai?** | **Yes, data replace** |
| **Action** | Keep table; copy schema; empty or seed Coimbatore civic issues. Same name or rename to `covai_elections_civic_issues` + update code if any. |

---

## 20. omrelections_constituencies
| Aspect | Assessment |
|--------|------------|
| **Schema** | type, name, district, state. Generic. |
| **Data** | Chennai South, Sholinganallur, etc. |
| **Suitable for Covai?** | **Yes, data replace** |
| **Action** | Keep table; replace with Coimbatore Lok Sabha + Assembly constituencies (e.g. Coimbatore, Coimbatore North/South). Same name or covai_* + update. |

---

## 21. omrelections_election_results
| Aspect | Assessment |
|--------|------------|
| **Schema** | constituency_id, election_type, year, winner. Generic. |
| **Data** | Chennai results. |
| **Suitable for Covai?** | **Yes, data replace** |
| **Action** | Keep table; copy schema; empty or Coimbatore results. Same name. |

---

## 22. omrelections_localities
| Aspect | Assessment |
|--------|------------|
| **Schema** | constituency_id, name, pincode. Generic. |
| **Data** | Sholinganallur, Velachery, etc. |
| **Suitable for Covai?** | **Yes, data replace** |
| **Action** | Keep table; replace with Coimbatore localities. Same name. |

---

## 23. omrelections_polling_stations
| Aspect | Assessment |
|--------|------------|
| **Schema** | constituency_id, locality_id, name, address. Generic. |
| **Data** | Chennai stations. |
| **Suitable for Covai?** | **Yes, data replace** |
| **Action** | Keep table; copy schema; empty or Coimbatore polling stations. Same name. |

---

## 24. omrelections_representatives
| Aspect | Assessment |
|--------|------------|
| **Schema** | constituency_id, name, party, role (MP/MLA). Generic. |
| **Data** | Chennai MPs/MLAs. |
| **Suitable for Covai?** | **Yes, data replace** |
| **Action** | Keep table; replace with Coimbatore representatives. Same name. |

---

## 25. omrelections_voter_services
| Aspect | Assessment |
|--------|------------|
| **Schema** | constituency_id, service_name, url. Generic. |
| **Data** | Links; may need URL/label updates. |
| **Suitable for Covai?** | **Yes, data replace** |
| **Action** | Keep table; copy schema; update for Coimbatore. Same name. |

---

## 26. omrhospitalslist
| Aspect | Assessment |
|--------|------------|
| **Schema** | hospitalname, address, locality, contact, type. Works for any city. |
| **Data** | OMR hospitals. |
| **Suitable for Covai?** | **Yes, data replace** |
| **Action** | Keep table name; copy schema; seed Coimbatore hospitals. **PHP uses:** `omr-listings/hospitals.php`, `hospital.php`, `generate-listings-sitemap.php`, admin, sitemap-generator. |

---

## 27. omrparkslist
| Aspect | Assessment |
|--------|------------|
| **Schema** | parkname, location, locality, features, timings. Generic. |
| **Data** | Chennai parks (Guindy, Semmozhi, etc.). |
| **Suitable for Covai?** | **Yes, data replace** |
| **Action** | Keep table; copy schema; seed Coimbatore parks (e.g. VOC Park, Brookefields). **PHP uses:** `omr-listings/parks.php`, `park.php`, admin, generate-listings-sitemap. |

---

## 28. omrschoolslist
| Aspect | Assessment |
|--------|------------|
| **Schema** | schoolname, address, locality, contact, landmark. Works for any city. |
| **Data** | OMR schools. |
| **Suitable for Covai?** | **Yes, data replace** |
| **Action** | Keep table; copy schema; seed Coimbatore schools. **PHP uses:** many—schools.php, school.php, omr-road-database-list.php, admin, homepage-listing-counts, generate-listings-sitemap. Note: `schools` and `omr_schools` also exist; consider one schools table for Covai. |

---

## 29. omr_atms
| Aspect | Assessment |
|--------|------------|
| **Schema** | bankname, address, locality, contact. Generic. |
| **Data** | OMR ATMs. |
| **Suitable for Covai?** | **Yes, data replace** |
| **Action** | Keep table; copy schema; seed Coimbatore ATMs. **PHP uses:** `omr-listings/atms.php`, `atm.php`, admin, generate-listings-sitemap. |

---

## 30. omr_election_blo
| Aspect | Assessment |
|--------|------------|
| **Schema** | BLO (Booth Level Officer) data: ac_no, polling station, BLO name, mobile. |
| **Data** | **Chennai only** – Shozhinganallur AC (27), 3000+ rows. Not Coimbatore. |
| **Suitable for Covai?** | **Yes** (schema only; data to be added later). |
| **Action** | **Chosen: Option B.** Create the same table in `metap8ok_mycovai`; leave it **empty**. When Coimbatore BLO data is available, import it later. **PHP uses:** `info/find-blo-officer.php`, `omr-election-blo/` (generate sitemap, process CSV)—will work with empty table until data is added. |

---

## 31. omr_gov_offices
| Aspect | Assessment |
|--------|------------|
| **Schema** | office_name, address, locality, contact. Generic. |
| **Data** | Chennai GCC, ELCOT, RTO Sholinganallur, etc. |
| **Suitable for Covai?** | **Yes, data replace** |
| **Action** | Keep table; copy schema; seed Coimbatore gov offices (Corporation, RTO, police, etc.). **PHP uses:** `omr-listings/government-offices.php`, `government-office.php`, admin, migrations. |

---

## 32. omr_industries
| Aspect | Assessment |
|--------|------------|
| **Schema** | industry_name, address, locality, industry_type. Generic. |
| **Data** | OMR industries (TCS, Cognizant, etc.). |
| **Suitable for Covai?** | **Yes, data replace** |
| **Action** | Keep table; copy schema; seed Coimbatore industries (textile, engineering, IT). **PHP uses:** `omr-listings/industries.php`, `industry.php`, admin, migrations, generate-listings-sitemap. |

---

## 33. omr_it_companies
| Aspect | Assessment |
|--------|------------|
| **Schema** | company_name, address, locality, industry_type. Works for any city. |
| **Data** | OMR IT companies. |
| **Suitable for Covai?** | **Yes, data replace** |
| **Action** | Keep table; copy schema; seed Coimbatore IT companies. **PHP uses:** locality pages, it-company.php, it-companies.php (incl. featured), generate-listings-sitemap, homepage-listing-counts. |

---

## 34. omr_it_companies_featured
| Aspect | Assessment |
|--------|------------|
| **Schema** | company_slno, rank, blurb, cta. Generic. |
| **Data** | OMR featured; start empty. |
| **Suitable for Covai?** | **Yes** |
| **Action** | Keep table; copy schema; empty. **PHP uses:** it-companies.php (featured block). Same name. |

---

## 35. omr_it_company_submissions
| Aspect | Assessment |
|--------|------------|
| **Schema** | User-submitted IT company; pending/approved. Generic. |
| **Data** | Start empty. |
| **Suitable for Covai?** | **Yes** |
| **Action** | Keep table; copy schema; empty. Same name. |

---

## 36. omr_it_parks
| Aspect | Assessment |
|--------|------------|
| **Schema** | name, locality, address, amenities. Generic. |
| **Data** | WTC Chennai, TIDEL, SIPCOT Siruseri—all Chennai. |
| **Suitable for Covai?** | **Yes, data replace** |
| **Action** | Keep table; copy schema; seed Coimbatore IT parks (e.g. TIDEL Coimbatore, KGISL Tech Park). Same name or covai_it_parks. |

---

## 37. omr_it_parks_featured
| Aspect | Assessment |
|--------|------------|
| **Schema** | park_id, rank, blurb. Generic. |
| **Data** | Start empty. |
| **Suitable for Covai?** | **Yes** |
| **Action** | Keep table; copy schema; empty. Same name. |

---

## 38. omr_restaurants
| Aspect | Assessment |
|--------|------------|
| **Schema** | name, address, locality, cuisine, cost_for_two, rating, geolocation. Works for any city. |
| **Data** | OMR restaurants. |
| **Suitable for Covai?** | **Yes, data replace** |
| **Action** | Keep table; copy schema; seed Coimbatore restaurants. **PHP uses:** omr-listings/restaurants.php, restaurant.php, generate-listings-sitemap, homepage-listing-counts. |

---

## 39. omr_schools
| Aspect | Assessment |
|--------|------------|
| **Schema** | Detailed schools: locality, curriculum, fee, principal. Works for any city. |
| **Data** | OMR schools (Chennai localities). |
| **Suitable for Covai?** | **Yes, data replace** |
| **Action** | Keep table; copy schema; seed Coimbatore schools. **PHP:** Check if used; may overlap with `schools` and `omrschoolslist`. Prefer one canonical schools table for Covai. |

---

## 40. organizers
| Aspect | Assessment |
|--------|------------|
| **Schema** | name, email, phone. Generic. |
| **Data** | Start empty. |
| **Suitable for Covai?** | **Yes** |
| **Action** | Keep table; copy schema; empty. Same name. |

---

## 41. property_inquiries
| Aspect | Assessment |
|--------|------------|
| **Schema** | property_id, user info, preferences. Generic. |
| **Data** | OMR inquiries; start fresh. |
| **Suitable for Covai?** | **Yes** |
| **Action** | Keep table; copy schema; empty. Same name. |

---

## 42. property_owners
| Aspect | Assessment |
|--------|------------|
| **Schema** | full_name, email, phone, password. Generic. |
| **Data** | OMR hostel/PG owners; Covai = new signups. |
| **Suitable for Covai?** | **Yes** |
| **Action** | Keep table; copy schema; empty. Same name. |

---

## 43. property_photos
| Aspect | Assessment |
|--------|------------|
| **Schema** | property_id, photo_url, category. Generic. |
| **Data** | Start empty. |
| **Suitable for Covai?** | **Yes** |
| **Action** | Keep table; copy schema; empty. Same name. |

---

## 44. property_reviews
| Aspect | Assessment |
|--------|------------|
| **Schema** | property_id, user, rating, text. Generic. |
| **Data** | Start empty. |
| **Suitable for Covai?** | **Yes** |
| **Action** | Keep table; copy schema; empty. Same name. |

---

## 45. saved_properties
| Aspect | Assessment |
|--------|------------|
| **Schema** | user_email, property_id. Generic. |
| **Data** | Start empty. |
| **Suitable for Covai?** | **Yes** |
| **Action** | Keep table; copy schema; empty. Same name. |

---

## 46. saved_spaces
| Aspect | Assessment |
|--------|------------|
| **Schema** | user_email, space_id. Generic. |
| **Data** | Start empty. |
| **Suitable for Covai?** | **Yes** |
| **Action** | Keep table; copy schema; empty. Same name. |

---

## 47. schools
| Aspect | Assessment |
|--------|------------|
| **Schema** | Richer: school_name, area, curriculum, fee_range, rating. Generic. |
| **Data** | OMR areas (Thoraipakkam, Perungudi, etc.). |
| **Suitable for Covai?** | **Yes, data replace** |
| **Action** | Keep table; copy schema; seed Coimbatore schools. **PHP:** discover-myomr (SDG), omr-listings (schools-new, directory). Consider merging with omrschoolslist/omr_schools for one schools table. |

---

## 48. space_inquiries
| Aspect | Assessment |
|--------|------------|
| **Schema** | space_id, user, requirements. Generic. |
| **Data** | Start empty. |
| **Suitable for Covai?** | **Yes** |
| **Action** | Keep table; copy schema; empty. Same name. |

---

## 49. space_owners
| Aspect | Assessment |
|--------|------------|
| **Schema** | full_name, company, email, phone. Generic. |
| **Data** | OMR workspace owners; Covai = new. |
| **Suitable for Covai?** | **Yes** |
| **Action** | Keep table; copy schema; empty. Same name. |

---

## 50. space_photos
| Aspect | Assessment |
|--------|------------|
| **Schema** | space_id, photo_url. Generic. |
| **Data** | Start empty. |
| **Suitable for Covai?** | **Yes** |
| **Action** | Keep table; copy schema; empty. Same name. |

---

## 51. space_reviews
| Aspect | Assessment |
|--------|------------|
| **Schema** | space_id, user, rating. Generic. |
| **Data** | Start empty. |
| **Suitable for Covai?** | **Yes** |
| **Action** | Keep table; copy schema; empty. Same name. |

---

## Summary: Suitability for Covai

| Verdict | Count | Tables |
|---------|--------|--------|
| **Yes** (schema only / empty) | 25 | admin_audit_log, admin_users, businesses, employers, event_attendees, event_submissions, gallery, job_applications, organizers, property_inquiries, property_owners, property_photos, property_reviews, saved_*, space_*, omr_it_companies_featured, omr_it_company_submissions, omr_it_parks_featured |
| **Yes, data replace** | 25 | articles, coworking_spaces, events, event_listings, hostels_pgs, job_postings, **List of Areas**, omrbankslist, omrelections_* (6), omrhospitalslist, omrparkslist, omrschoolslist, omr_atms, omr_gov_offices, omr_industries, omr_it_companies, omr_it_parks, omr_restaurants, omr_schools, schools |
| **Yes** (categories – copy data) | 2 | event_categories, job_categories |
| **Yes (empty; add BLO later)** | 1 | omr_election_blo – schema only; Coimbatore BLO data to be imported later. |

**Conclusion:** **All 51 tables are suitable for Covai.** **omr_election_blo:** create table in `metap8ok_mycovai` with the same schema; leave it **empty** and add Coimbatore BLO data when available (Option B). All other tables: keep same names for zero PHP change; use Coimbatore seed data or leave empty as per the table log above.
